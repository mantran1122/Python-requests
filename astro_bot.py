import sys, json
from vedastro import *

def run():
    try:
        # Nhận dữ liệu từ Laravel
        data = json.loads(sys.stdin.read())

        name = data["name"]
        birth_date = data["birth_date"]  # yyyy-mm-dd
        birth_time = data.get("birth_time", "00:00")
        gender = data["gender"]
        birth_place = data["birth_place"]

        # Tạm mặc định timezone +07:00 (bạn có thể cải tiến sau)
        birth_str = f"{birth_time} {birth_date.replace('-', '/')} +07:00"

        # Vị trí địa lý mẫu (bạn có thể tích hợp Google Maps API để lấy đúng lat/lon theo birth_place)
        geo = GeoLocation(birth_place, 105.85, 21.03)  # ví dụ: Hà Nội
        time = Time(birth_str, geo)

        # Lấy thông tin hành tinh Mặt Trời
        sun_data = Calculate.AllPlanetData(PlanetName.Sun, time)

        # Lấy thông tin House 1 (Ascendant)
        house1_data = Calculate.AllHouseData(HouseName.House1, time)

        # Trả dữ liệu về Laravel
        print(json.dumps({
            "name": name,
            "zodiac": str(sun_data.Placement.Constellation.Name),
            "planet_position": str(sun_data.Placement.Longitude),
            "house1": str(house1_data.Placement.Sign.Name),
        }))
    except Exception as e:
        print(json.dumps({"error": str(e)}))

if __name__ == "__main__":
    run()
