# Use Node.js for building the Vue.js app
FROM node:16 AS build-stage

# Set working directory
WORKDIR /app

# Copy the application code
COPY . .

# Install dependencies
RUN npm install

# Build the application
RUN npm run build

# Use Nginx to serve the frontend
FROM nginx:alpine

# Copy built assets from the build stage
COPY --from=build-stage /app/dist /usr/share/nginx/html

# Expose the application port
EXPOSE 80

# Command to run Nginx
CMD ["nginx", "-g", "daemon off;"]
