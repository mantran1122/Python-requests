from langchain.prompts import PromptTemplate
from langchain.chat_models import ChatOpenAI

# Tạo prompt template
prompt_template = PromptTemplate(
    input_variables=["question"], 
    template="Please provide a detailed answer to the following question: {question}"
)

# Khởi tạo mô hình ChatOpenAI
llm = ChatOpenAI(model="gpt-3.5-turbo")

# Định dạng prompt với câu hỏi
formatted_prompt = prompt_template.format(question="What is LangChain?")
response = llm(formatted_prompt)

# In câu trả lời từ mô hình
print(response)
