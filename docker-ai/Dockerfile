# Utilise une image Node.js officielle
FROM node:20-alpine

# Crée le dossier de l'app
WORKDIR /app

# Copie les fichiers package.json et package-lock.json
COPY package*.json ./

# Installe les dépendances
RUN npm install --production

# Copie le code source
COPY server.js ./

# Expose le port utilisé par Express
EXPOSE 3001

# Commande de démarrage
CMD ["node", "server.js"]

