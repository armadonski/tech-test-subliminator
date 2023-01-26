ARG NODE_VERSION

FROM node:${NODE_VERSION}

WORKDIR /app
RUN npm install -g @angular/cli \
    ;

EXPOSE 4200

CMD ["ng", "serve", "--host", "0.0.0.0", "--port", "4200", "--watch"]