import pandas as pd
from sqlalchemy import create_engine

# CSV dosyasının yolu
csv_file_path = r'C:\xampp\htdocs\IVT\.py\temizlenmis_diabetes.csv'

# CSV dosyasını DataFrame olarak yükle
df = pd.read_csv(csv_file_path)

# MySQL veritabanı bağlantısı
db_config = {
    'user': 'root',
    'password': '',  # MySQL root kullanıcısı için şifre girin
    'host': 'localhost',
    'database': 'diabetes_db'
}

# SQLAlchemy engine oluştur
engine = create_engine(f"mysql+mysqlconnector://{db_config['user']}:{db_config['password']}@{db_config['host']}/{db_config['database']}")

# DataFrame'i MySQL veritabanındaki bir tabloya yaz
df.to_sql('diabetes', con=engine, if_exists='replace', index=False)

print("CSV verileri başarıyla MySQL veritabanına aktarıldı.")
