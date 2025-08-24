model https://huggingface.co/bigcode/starcoder2-7b
license https://www.bigcode-project.org/docs/pages/bigcode-openrail/

## Model Downloader

### Build

```shell
docker build . -f Dockerfile.downloader -t abenevaut/starcoder2-7b:downloader-latest --build-arg HUGGINGFACE_TOKEN=yourHuggingFaceToken
```

### Run

```shell
docker run \
  -v ./.ai_data/models:/models \
  -v ./.ai_data/checkpoints:/checkpoints \
  -v ./.ai_data/training_runs:/training_runs \
  -v ./.ai_data/packagist:/data/packagist \
  -v ./.ai_data/phpnet:/data/phpnet \
  abenevaut/starcoder2-7b:downloader-latest
```

## Model finetuning

### Build

```shell
docker build . -t -f Dockerfile.finetuner abenevaut/starcoder2-7b:finetuner-latest --build-arg HUGGINGFACE_TOKEN=yourHuggingFaceToken
```

### Run

```shell
docker run --gpus all \
  -v ./.ai_data/models:/models \
  -v ./.ai_data/checkpoints:/checkpoints \
  -v ./.ai_data/training_runs:/training_runs \
  -v ./.ai_data/packagist:/data/packagist \
  -v ./.ai_data/phpnet:/data/phpnet \
  abenevaut/starcoder2-7b:finetuner-latest
```
