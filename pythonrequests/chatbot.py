import os
import faiss
from langchain.embeddings import OpenAIEmbeddings
from langchain.vectorstores import FAISS
from langchain.document_loaders import TextLoader
from langchain.chains import ConversationalRetrievalChain
from langchain.chat_models import ChatOpenAI
from langchain.prompts import PromptTemplate

folder_path = r"E:\testtxt"

documents = []
for filename in os.listdir(folder_path):
    if filename.endswith(".txt"):
        with open(os.path.join(folder_path, filename), 'r') as file:
            documents.append(file.read())

embedding_model = OpenAIEmbeddings()

embeddings = embedding_model.embed_documents(documents)

dimension = len(embeddings[0])
index = faiss.IndexFlatL2(dimension)
index.add(embeddings)

faiss.write_index(index, "document_index.index")

prompt_template = PromptTemplate(
    input_variables=["question"],
    template="Use the following context to answer the question: {context}. Question: {question}"
)

llm = ChatOpenAI(model="gpt-3.5-turbo")

faiss_vectorstore = FAISS.from_documents(documents, embedding_model)

qa_chain = ConversationalRetrievalChain.from_llm(
    llm,
    retriever=faiss_vectorstore.as_retriever()
)

query = "What is LangChain?"
response = qa_chain.run(query)

print(response)