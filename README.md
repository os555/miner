# miner
Claymore Monitor Dashboard

How it currently looks: 
![alt text](https://raw.githubusercontent.com/adonisd/miner/master/images/sample/Capture.JPG)
![alt text](https://raw.githubusercontent.com/adonisd/miner/master/images/sample/Capture2.JPG)
![alt text](https://raw.githubusercontent.com/adonisd/miner/master/images/sample/Capture3.JPG)
![alt text](https://raw.githubusercontent.com/adonisd/miner/master/images/sample/Capture4.JPG)

Node-red Import Flow: 
<code>
[
    {
        "id": "de1f0c12.2e9be",
        "type": "tcp request",
        "z": "ebe0005f.188b18",
        "server": "10.2.0.11",
        "port": "3333",
        "out": "sit",
        "splitc": " ",
        "name": "miner00",
        "x": 442.5,
        "y": 187,
        "wires": [
            [
                "1f288e9a.34e6e1"
            ]
        ]
    },
    {
        "id": "1f288e9a.34e6e1",
        "type": "function",
        "z": "ebe0005f.188b18",
        "name": "",
        "func": "msg.payload = msg.payload.toString('utf8');\nreturn msg;",
        "outputs": 1,
        "noerr": 0,
        "x": 716.5,
        "y": 375,
        "wires": [
            [
                "26c8ae26.e178e2"
            ]
        ]
    },
    {
        "id": "753fa959.4009a8",
        "type": "inject",
        "z": "ebe0005f.188b18",
        "name": "",
        "topic": "",
        "payload": "{\"jsonrpc\":\"2.0\",\"method\":\"miner_getstat1\"}",
        "payloadType": "json",
        "repeat": "10",
        "crontab": "",
        "once": true,
        "x": 94.5,
        "y": 192,
        "wires": [
            [
                "f1e21912.c5e1a"
            ]
        ]
    },
    {
        "id": "f1e21912.c5e1a",
        "type": "function",
        "z": "ebe0005f.188b18",
        "name": "",
        "func": "var msg1 = { payload: '{\"id\":0,\"jsonrpc\":\"2.0\",\"method\":\"miner_getstat1\"}' };\nvar msg2 = { payload: '{\"id\":1,\"jsonrpc\":\"2.0\",\"method\":\"miner_getstat1\"}' };\nvar msg3 = { payload: '{\"id\":2,\"jsonrpc\":\"2.0\",\"method\":\"miner_getstat1\"}' };\nvar msg4 = { payload: '{\"id\":3,\"jsonrpc\":\"2.0\",\"method\":\"miner_getstat1\"}' };\nvar msg5 = { payload: '{\"id\":4,\"jsonrpc\":\"2.0\",\"method\":\"miner_getstat1\"}' };\nvar msg6 = { payload: '{\"id\":5,\"jsonrpc\":\"2.0\",\"method\":\"miner_getstat1\"}' };\nvar msg7 = { payload: '{\"id\":6,\"jsonrpc\":\"2.0\",\"method\":\"miner_getstat1\"}' };\n\nreturn [[msg1], [msg2], [msg3], [msg4], [msg5], [msg6], [msg7]];",
        "outputs": "7",
        "noerr": 0,
        "x": 192.5,
        "y": 359,
        "wires": [
            [
                "de1f0c12.2e9be"
            ],
            [
                "e9f0f698.f6082"
            ],
            [
                "dc90dea8.5de828"
            ],
            [
                "9d2171cb.26c2c"
            ],
            [
                "d76b00fa.a395e8"
            ],
            [
                "1dfc898d.41590e"
            ],
            [
                "c300dd52.dfe92"
            ]
        ]
    },
    {
        "id": "228c80d8.f3628",
        "type": "websocket in",
        "z": "ebe0005f.188b18",
        "name": "",
        "server": "601df59e.6f0314",
        "client": "",
        "x": 98.5,
        "y": 594,
        "wires": [
            [
                "f1e21912.c5e1a"
            ]
        ]
    },
    {
        "id": "26c8ae26.e178e2",
        "type": "websocket out",
        "z": "ebe0005f.188b18",
        "name": "",
        "server": "601df59e.6f0314",
        "client": "",
        "x": 898.5,
        "y": 376,
        "wires": []
    },
    {
        "id": "e9f0f698.f6082",
        "type": "tcp request",
        "z": "ebe0005f.188b18",
        "server": "10.2.0.6",
        "port": "3333",
        "out": "time",
        "splitc": "0",
        "name": "miner01",
        "x": 441,
        "y": 261,
        "wires": [
            [
                "1f288e9a.34e6e1"
            ]
        ]
    },
    {
        "id": "dc90dea8.5de828",
        "type": "tcp request",
        "z": "ebe0005f.188b18",
        "server": "10.2.0.7",
        "port": "3333",
        "out": "time",
        "splitc": "0",
        "name": "miner02",
        "x": 434,
        "y": 314,
        "wires": [
            [
                "1f288e9a.34e6e1"
            ]
        ]
    },
    {
        "id": "9d2171cb.26c2c",
        "type": "tcp request",
        "z": "ebe0005f.188b18",
        "server": "10.2.0.5",
        "port": "3333",
        "out": "time",
        "splitc": "0",
        "name": "miner03",
        "x": 434,
        "y": 365,
        "wires": [
            [
                "1f288e9a.34e6e1"
            ]
        ]
    },
    {
        "id": "d76b00fa.a395e8",
        "type": "tcp request",
        "z": "ebe0005f.188b18",
        "server": "10.2.0.8",
        "port": "3333",
        "out": "time",
        "splitc": "0",
        "name": "miner04",
        "x": 438,
        "y": 431,
        "wires": [
            [
                "1f288e9a.34e6e1"
            ]
        ]
    },
    {
        "id": "1dfc898d.41590e",
        "type": "tcp request",
        "z": "ebe0005f.188b18",
        "server": "10.2.0.9",
        "port": "3333",
        "out": "time",
        "splitc": "0",
        "name": "miner05",
        "x": 439,
        "y": 492,
        "wires": [
            [
                "1f288e9a.34e6e1"
            ]
        ]
    },
    {
        "id": "c300dd52.dfe92",
        "type": "tcp request",
        "z": "ebe0005f.188b18",
        "server": "10.2.0.10",
        "port": "3333",
        "out": "time",
        "splitc": "0",
        "name": "miner06",
        "x": 436,
        "y": 540,
        "wires": [
            [
                "1f288e9a.34e6e1"
            ]
        ]
    },
    {
        "id": "8b94ea43.19fa2",
        "type": "e-mail",
        "z": "ebe0005f.188b18",
        "server": "smtp.office365.com",
        "port": "587",
        "secure": false,
        "name": "email@email.email",
        "dname": "EMAIL",
        "x": 534,
        "y": 94,
        "wires": []
    },
    {
        "id": "961e889f.03be48",
        "type": "catch",
        "z": "ebe0005f.188b18",
        "name": "",
        "scope": null,
        "x": 77,
        "y": 92,
        "wires": [
            [
                "8595333e.546048"
            ]
        ]
    },
    {
        "id": "8595333e.546048",
        "type": "function",
        "z": "ebe0005f.188b18",
        "name": "",
        "func": "msg.topic = msg.error;\nmsg.payload = msg.error;\nreturn msg;",
        "outputs": 1,
        "noerr": 0,
        "x": 355,
        "y": 94,
        "wires": [
            [
                "8b94ea43.19fa2"
            ]
        ]
    },
    {
        "id": "601df59e.6f0314",
        "type": "websocket-listener",
        "z": "",
        "path": "/ws/miner",
        "wholemsg": "false"
    }
]
</code>
