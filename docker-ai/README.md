# Docker AI

## Resources

- https://www.docker.com/blog/run-llms-locally/
- https://www.youtube.com/watch?v=rGGZJT3ZCvo

## Setup

```
docker desktop enable model-runner
```

Install model(s)
```
docker model pull ai/smollm2:latest
docker model pull ai/mistral:latest
docker model pull ai/mistral-nemo:latest
```

Use model(s) from CLI
```
docker model run ai/smollm2:360M-Q4_K_M "Give me a fact about whales."
docker model run ai/smollm2:latest "Give me a fact about whales."
docker model run ai/mistral:latest "Give me a fact about whales."
docker model run ai/mistral-nemo:latest "Give me a fact about whales."
```

Use in containers API `const MODEL_URL = 'http://model-runner.docker.internal/engines/v1';`.

Use model from localhost with server.js : `const MODEL_URL = 'http://localhost:12434/engines/v1';`.
You should enable local port to access API.
```
docker desktop enable model-runner --tcp=12434
```

## The project

Adjust `const MODEL_NAME` & `const MODEL_URL` in server.js, then:
```
docker-compose build --no-cache
docker-compose up -d
```

## Todo
- use MCP in chat https://hub.docker.com/r/docker/mcp-gateway

## Next ?
- https://www.docker.com/blog/llm-docker-for-local-and-hugging-face-hosting/
