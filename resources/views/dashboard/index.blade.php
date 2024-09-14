<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard IoT</title>
    <style>
        * {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        body {
            background-color: #f4f4f9
        }
        #container {
            height: 100vh;
            padding: 0 50px;
        }
        .row {
            display: flex;
            flex-direction: row;
            padding: 20px 0;
            gap: 15px;
        }
        .card {
            width: 25%;
            padding: 25px 15px;
            background-color: #fff;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            box-shadow: 0 2px 10px #888;
        }
        .text-suhu {
            font-size: 22px;
            color: #F05A7E;
        }
        .text-kelembapan {
            font-size: 22px;
            color: #3795BD;
        }
        .text-posisi-servo {
            font-size: 20px;
            color: rgb(51, 46, 46)
        }
        #input-lcd {
            outline: 0;
            border: 1px solid lightgray;
            padding: 15px;
            border-radius: 5px;
        }
        #btn-submit {
            outline: 0;
            border: 0;
            background: #3795BD;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .card-table {
            width: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            padding: 15px 0;
            background: #3795BD;
            color: white;
        }
        td {
            padding: 15px 0;
            text-align: center;
        }
        .status-online {
            color: lightgreen;
        }
        .status-offline {
            color: red;
        }

        @media only screen and (max-width: 600px) {
            .row {
                flex-direction: column;
            }
            .card {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <main>
        <section id="container">
            <div class="row">
                <div class="card">
                    <h3>Suhu</h3>
                    <p class="text-suhu">25°C</p>
                </div>
                <div class="card">
                    <h3>Kelembapan</h3>
                    <p class="text-kelembapan">60%</p>
                </div>
                <div class="card">
                    <h3>Posisi Servo</h3>
                    <input type="range" min="0" max="180" value="90" name="servo-slider" id="servo-slider">
                    <p class="text-posisi-servo" id="servo-text">90°</p>
                </div>
                <div class="card">
                    <h3>Display LCD</h3>
                    <input type="text" name="text-lcd" id="input-lcd" placeholder="Masukkan Teks">
                    <button type="button" id="btn-submit">Submit</button>
                </div>
            </div>

            <div class="row">
                <div class="card card-table">
                    <table border="1">
                        <thead>
                            <tr>
                                <th>ID Device</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($devices as $item)
                                <tr>
                                    <td>
                                        <span>{{ $item->serial_number }}</span>
                                    </td>
                                    <td>
                                        <span class="status-online">Online</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <script>
        const servoSlider = document.getElementById('servo-slider');
        const textServo = document.getElementById('servo-text');

        servoSlider.addEventListener('input', () => {
            textServo.textContent = `${servoSlider.value}°`;
        });

        const btnSubmit = document.getElementById('btn-submit');
        const inputLcd = document.getElementById('input-lcd');

        btnSubmit.addEventListener('click', () => {
            const textValue = inputLcd.value;

            if (!textValue) {
                alert('Teks harus diisi');
            } else {
                alert(`text value => ${textValue}`)
            }
        });

    </script>
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
    <script>
        const clientId = Math.random().toString(16).substring(2,8)
        const host = "wss://broker.emqx.io:8084/mqtt"

        const options = {
            keepalive: 30,
            clientId: clientId,
            protocolId: 'MQTT',
            protocolVersion: 4,
            clean: true,
            reconnectPeriod: 1000,
            connectTimeout: 30 * 1000
        }

        console.log("Menghubungkan ke broker");
        const client = mqtt.connect(host, options);
        client.subscribe("nusabot/#",{qos: 1});

        client.on("connect", ()=>{
            console.log("Terhubung ke broker");
        })
    </script>
</body>
</html>
