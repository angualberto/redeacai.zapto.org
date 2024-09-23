import asyncio
import websockets

async def chat(websocket, path):
    async for message in websocket:
        await websocket.send(f"Você disse: {message}")

start_server = websockets.serve(chat, "localhost", 6789)

asyncio.get_event_loop().run_until_complete(start_server)
asyncio.get_event_loop().run_forever()
