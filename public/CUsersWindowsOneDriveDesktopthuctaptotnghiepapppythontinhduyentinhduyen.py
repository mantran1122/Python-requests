
import requests
import json
import urllib.parse
import os

# ---------- HÀM GỌI API VEDASTRO ----------
def get_api_base():
    return "https://api.vedastro.org/api/Calculate/"

def get_all_data(name, location, time, date, timezone):
    base_url = get_api_base()
    encoded_location = urllib.parse.quote(location, safe='')
    common_path = f"Location/{encoded_location}/Time/{time}/{date}/{timezone}/"

    apis = {
        "all_planet_data": f"{base_url}AllPlanetData/PlanetName/Moon/{common_path}",
        "moon_constellation": f"{base_url}MoonConstellation/{common_path}",
        "yoni_kuta": f"{base_url}YoniKutaAnimal/{common_path}",
    }

    result = {"name": name}
    for key, url in apis.items():
        print(f"🔗 Gọi API: {url}")
        response = requests.get(url)
        if response.status_code == 200:
            try:
                result[key] = response.json()
            except Exception as e:
                result[key] = {"error": f"Lỗi parse JSON: {str(e)}"}
        else:
            result[key] = {"error": f"Lỗi API: {response.status_code}"}
    return result

# ---------- CHẠY CHƯƠNG TRÌNH ----------
if __name__ == "__main__":
    print("🔮 PHÂN TÍCH TÌNH DUYÊN TỰ ĐỘNG TỪ FILE input.json 🔽")

    try:
        base_dir = os.path.dirname(__file__)
        input_path = os.path.join(base_dir, "input.json")
        output_path = os.path.join(base_dir, "love_analysis_data.json")

        with open(input_path, "r", encoding="utf-8") as f:
            input_data = json.load(f)

        a = input_data["person_a"]
        b = input_data["person_b"]

        person_a = get_all_data(a["name"], a["location"], a["time"], a["date"], "+07:00")
        person_b = get_all_data(b["name"], b["location"], b["time"], b["date"], "+07:00")

        love_data = {
            "person_a": person_a,
            "person_b": person_b
        }

        with open(output_path, "w", encoding="utf-8") as f:
            json.dump(love_data, f, ensure_ascii=False, indent=2)

        print("\n✅ Đã lưu kết quả tại:", output_path)
    except Exception as e:
        print("❌ Lỗi:", str(e))
