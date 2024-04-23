FROM node:alpine

WORKDIR /var/www/project

COPY frontend/package*.json ./

RUN npm install


EXPOSE 3000

CMD ["npm", "start"]