https://www.docker.com/blog/run-llms-locally/
https://www.youtube.com/watch?v=rGGZJT3ZCvo

docker desktop enable model-runner
docker desktop enable model-runner --tcp=12434

docker model run ai/smollm2:360M-Q4_K_M "Give me a fact about whales."
docker model run ai/smollm2:latest "Give me a fact about whales."

Todo
- use MCP in chat https://hub.docker.com/r/docker/mcp-gateway


later:
- https://www.docker.com/blog/llm-docker-for-local-and-hugging-face-hosting/