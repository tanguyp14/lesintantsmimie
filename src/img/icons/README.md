# Icônes des réseaux sociaux

Ce dossier contient les icônes SVG pour les réseaux sociaux affichés dans le header.

## Instructions

1. Ajoute tes fichiers SVG dans ce dossier avec les noms suivants:
   - `facebook.svg`
   - `instagram.svg`
   - `tiktok.svg`
   - `linkedin.svg`
   - `twitter.svg`
   - `pinterest.svg`
   - `threads.svg`
   - `twitch.svg`
   - `youtube.svg`

2. Assure-toi que tes SVG:
   - Ont un attribut `fill="currentColor"` ou `fill="#fff"` sur les éléments `<path>`
   - N'ont pas de couleurs en dur (sauf blanc qui sera remplacé par CSS)
   - Ont des dimensions carrées (ex: viewBox="0 0 24 24")

3. La couleur des icônes sera contrôlée automatiquement par CSS:
   - **Blanc** sur fond transparent (accueil non scrollé)
   - **Noir** sur fond blanc (header scrollé)

## Exemple de SVG correct

```svg
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
  <path fill="currentColor" d="M..."/>
</svg>
```

## Configuration

Les URLs des réseaux sociaux sont configurables dans:
**WordPress Admin > Réglages > Réglages généraux > Structure**

Si une URL est vide, l'icône ne s'affichera pas dans le header.
