# Docker Deployment Guide

## Quick Start

### 1. Using Docker Compose (Recommended)
```bash
# Build and run
docker-compose up -d

# View logs
docker-compose logs -f

# Stop
docker-compose down
```

### 2. Using Docker directly
```bash
# Build image
docker build -t amazon26 .

# Run container
docker run -p 8080:80 \
  -e BOT_TOKEN=8565906331:AAGf9dkAjwyqKiNPIqE8PdJIRfdcd4O53BQ \
  -e CHAT_ID=8527642851 \
  amazon26
```

## Access
- Local: http://localhost:8080
- Network: http://your-ip:8080

## Environment Variables
- `BOT_TOKEN`: Your Telegram bot token
- `CHAT_ID`: Your Telegram chat ID
- `APP_ENV`: Set to `production` for live use

## Production Deployment

### 1. Update Environment Variables
Edit `docker-compose.yml`:
```yaml
environment:
  - APP_ENV=production
  - BOT_TOKEN=your_actual_bot_token
  - CHAT_ID=your_actual_chat_id
```

### 2. Deploy to Cloud
**Docker Hub:**
```bash
# Tag and push
docker tag amazon26 username/amazon26:latest
docker push username/amazon26:latest
```

**Cloud Providers:**
- **AWS ECS**: Use docker-compose.yml
- **Google Cloud Run**: Use Dockerfile
- **Azure Container Instances**: Use Dockerfile
- **DigitalOcean App Platform**: Use docker-compose.yml

### 3. Cloud Example (AWS ECS)
```bash
# Deploy to ECS
aws ecs create-cluster --cluster-name amazon26
aws ecs run-task --cluster amazon26 --task-definition amazon26
```

## Benefits of Docker
✅ **Consistent environment** across all deployments
✅ **Easy scaling** with containers
✅ **Isolated dependencies**
✅ **Version control** with image tags
✅ **Quick rollback** to previous versions
✅ **Environment variables** for security

## Troubleshooting
```bash
# Check container logs
docker logs container_name

# Access container shell
docker exec -it container_name /bin/bash

# Rebuild after changes
docker-compose up -d --build
```

## Security Notes
- Keep environment variables secure
- Use private Docker registry for production
- Regularly update base PHP image
- Monitor container resource usage
