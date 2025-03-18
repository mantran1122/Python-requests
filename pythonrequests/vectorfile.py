import os
import faiss
from langchain.embeddings import OpenAIEmbeddings
from langchain.vectorstores import FAISS
from langchain.document_loaders import TextLoader

# Thư mục chứa các file .txt
folder_path = "C:\Users\Windows\PYrequests\pythonrequests\chiemtinh.txt"

# Tải tất cả các file .txt từ thư mục vào
documents = []
for filename in os.listdir(folder_path):
    if filename.endswith(".txt"):
        with open(os.path.join(folder_path, filename), 'r') as file:
            documents.append(file.read())

# Sử dụng OpenAI Embedding (hoặc bất kỳ mô hình embedding nào bạn chọn)
embedding_model = OpenAIEmbeddings()

# Tạo vector embeddings cho các tài liệu văn bản
embeddings = embedding_model.embed_documents(documents)

# FAISS index creation
dimension = len(embeddings[0])  # Chiều dài của vector
index = faiss.IndexFlatL2(dimension)  # Index với khoảng cách L2
index.add(embeddings)  # Thêm các vector vào index FAISS

# Lưu index FAISS vào file (tùy chọn)
faiss.write_index(index, "document_index.index")

# Nếu muốn tìm kiếm, bạn có thể sử dụng FAISS như sau:
# Giả sử bạn có một câu hỏi và muốn tìm văn bản gần nhất trong tập dữ liệu
query = "What is AI?"
query_embedding = embedding_model.embed_documents([query])  # Embedding câu truy vấn
D, I = index.search(query_embedding, k=5)  # Lấy 5 tài liệu gần nhất

# In các kết quả tìm kiếm
print("Top 5 closest documents:")
for i in range(5):
    print(f"Document {i+1}: {documents[I[0][i]]} (Distance: {D[0][i]})")
