import pandas as pd
from sklearn.preprocessing import MinMaxScaler

# Veri setini yükleyin
file_path = r'C:\xampp\htdocs\IVT\.py\diabetes.csv'
df = pd.read_csv(file_path)

# Eksik verileri kontrol edin ve eksik verileri doldurun (örneğin, ortalama ile)
df.fillna(df.mean(), inplace=True)

# Anlamsız verileri kontrol edin ve ele alın (örneğin, yaş sütununda negatif değerleri ortalama ile değiştirin)
for column in df.columns:
    if (df[column] < 0).any():
        df[column] = df[column].apply(lambda x: df[column].mean() if x < 0 else x)

# Özellikleri ölçeklendirin (örneğin, Min-Max ölçeklendirme)
scaler = MinMaxScaler()
df[['Pregnancies', 'Glucose', 'BloodPressure', 'SkinThickness', 'Insulin', 'BMI', 'DiabetesPedigreeFunction', 'Age']] = scaler.fit_transform(df[['Pregnancies', 'Glucose', 'BloodPressure', 'SkinThickness', 'Insulin', 'BMI', 'DiabetesPedigreeFunction', 'Age']])

# Temizlenmiş ve dönüştürülmüş veriyi gösterin
print(df.head())

# Temizlenmiş veriyi CSV dosyasına kaydedin (isteğe bağlı)
df.to_csv('temizlenmis_diabetes.csv', index=False)
