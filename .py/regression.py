import pandas as pd
import numpy as np
from sklearn.preprocessing import MinMaxScaler, PolynomialFeatures
from sklearn.linear_model import LinearRegression
from sklearn.metrics import mean_squared_error, r2_score
import mysql.connector

# Veri setini yükleyin
file_path = r'C:\xampp\htdocs\IVT\.py\diabetes.csv'
df = pd.read_csv(file_path)

# Eksik verileri kontrol edin ve eksik verileri doldurun (örneğin, ortalama ile)
df.fillna(df.mean(), inplace=True)

# Tüm sütunlarda negatif değerleri kontrol ediyoruz ve ortalama ile değiştiriyoruz
for column in df.columns:
    if (df[column] < 0).any():
        df[column] = df[column].apply(lambda x: df[column].mean() if x < 0 else x)

# Özellikleri ölçeklendiriyoruz (örneğin, Min-Max ölçeklendirme)
scaler = MinMaxScaler()
features = ['Pregnancies', 'Glucose', 'BloodPressure', 'SkinThickness', 'Insulin', 'BMI', 'DiabetesPedigreeFunction', 'Age']
df[features] = scaler.fit_transform(df[features])

# Bağımsız ve bağımlı değişkenleri belirleyiyoruz
X = df[features]
y = df['Outcome']

# Polinomial özellikler oluşturun
poly = PolynomialFeatures(degree=2)
X_poly = poly.fit_transform(X)

# Polinomial regresyon modelini oluşturun ve eğitin
model = LinearRegression()
model.fit(X_poly, y)

# Modelin performansını değerlendirin
y_pred = model.predict(X_poly)
mse = mean_squared_error(y, y_pred)
r2 = r2_score(y, y_pred)

print(f'Mean Squared Error: {mse}')
print(f'R^2 Score: {r2}')

# MySQL veritabanına bağlanın
db_config = {
    'user': 'root',
    'password': '',  # MySQL root kullanıcısı için şifre girin
    'host': 'localhost',
    'database': 'diabetes_db'
}
conn = mysql.connector.connect(**db_config)
cursor = conn.cursor()

# Temizlenmiş veriyi mevcut tabloya ekleyin
for _, row in df.iterrows():
    cursor.execute("""
        INSERT INTO diabetes_regression (Pregnancies, Glucose, BloodPressure, SkinThickness, Insulin, BMI, DiabetesPedigreeFunction, Age, Outcome)
        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)
    """, tuple(row))

# Değişiklikleri kaydedin ve bağlantıyı kapatın
conn.commit()
cursor.close()
conn.close()
