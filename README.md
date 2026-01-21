# TYLT Starter Theme
Starter WP Theme

## --TODO--
- ~~Ajouter un fichier `.env`pour charger le CSS et JS minifié en prod~~

## Installation
Dans le dossier `wp-content/themes` : 
1. `git init`
2. `git clone https://github.com/tanguyp14/le_tengu_starter`
3. `rm -rf .git`
4. `cd le_tengu_starter`
5. `rm -rf .git`
6. `npm install`

Avant de poursuivre, réalisez ces tâches : 
- Renommer le dossier du thème avec un nom correspondant au projet
- Effectuer un rechercher/remplacer sur 'TYLT' et le remplacer avec un slug correspondant au projet
- Effectuer un rechercher/remplacer sur 'TYLT' et le remplacer avec un nom correspondant au projet

## Déplacer le fichier mu-plugin
Le mettre à la racine à coté des plug-ins

## Installer ACF sinon ça marche po

## Créer un dépôt Git pour accueillir le thème
Créer un repo Git __vide sans README__ 

## Relier le thème à un dépôt Git
Dans le dossier du thème renommé : 
- `git init`
- `git remote add origin url_du_repo_git`
- `git branch -M main`
- `git add .`
- `git commit -m 'Initial commit'`
- `git push -u origin main`


Préfixez les fonctions du thèmes avec le slug correspondant au projet pour éviter tous conflits 

( ex : `function slug_projet_replace_content(){}`)

### Gestion des fichiers CSS et JS minifiés et non minifiés
Le thème est configuré pour vérifier la valeur de la constante `SCRIPT_DEBUG`:
- Si elle est égale à `true`: les versions non minifiées sont chargées
- Si elle est égale à `false`: les versions minifiées sont chargées

### Commandes NPM
Le thème utilise Gulp pour les tâches suivantes : 
- Compilation des fichiers SCSS en CSS
- Concaténation des fichiers JS
- Optimisation des images
- Création d'un sprite des SVG situés dans le dossier `svg-sprite` vers le fichier `sprite.svg.php`
- Surveillance et rechargement automatique du navigateur lors de la modification des fichiers CSS, JS et PHP

Avant de lancer les commandes NPM, assurez-vous que l'URL du site en local est bien renseigné dans le fichier `gulpfile.babel.js` à la ligne __20__.

Les commandes NPM suivantes sont disponibles : 
- `dev` : compilation des fichiers SCSS en CSS (sans minification et avec sourcemap), concaténation des fichiers JS (sauf vendor et avec sourcemap), optimisation des images, surveillance des fichiers, rafraîchissement automatique du navigateur lors des changements et copie des fichiers dans le dossier `/dist`
- `preprod` : mêmes actions que la commande `dev` mais sans le lancement et le rafraîchissement automatique du navigateur - utilisé dans l'outil de déploiement continu
- `prod` : compilation et minification des fichiers SCSS en CSS (sans sourcemap), concaténation et minification des fichiers JS (sauf vendor et sans sourcemap), optimisation des images et copie des fichiers dans le dossier `/dist`

__Rappel :__ Ces commandes sont à lancer avec `npm run` avant, ex : `npm run dev` et peuvent être interrompues avec `ctrl + c`