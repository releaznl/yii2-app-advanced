# Workflow in deze development omgeving:

## Development:
- Voer `composer.phar install` uit.
- Tijdens development initialiseer je yii naar de 'Development' omgeving. Voer daarom `php init` uit in de root van het project en volg eventuele instructies.
- Tijdens initialisatie is er een `common/config/config.yml.example` bestand aangemaakt. Dupliceer dit bestand naar `common/config/config.yml` en voer eventuele secrets in. Dit bestand wordt nooit meegepushed.
- Wanneer er nieuwe dependencies worden toegevoegd, wordt eenmalig `composer.phar update` uitgevoerd. Daarna wordt de .lock file altijd meegepushed.

## Deployment:
- Zorg ervoor dat je `deploy-config.yml.example` gedupliceerd naar `deploy-config.yml`. Vul/pas zonodig dit bestand aan.
- Zie: README_custom.md voor meer informatie over dit bestand
- SSH toegang lokaal naar de deployment server is noodzakelijk. Check dit via `ssh username@ip`.
- Voer `ssh-add` uit. En check zonodig met `ssh-add -l`. Dit zorgt ervoor dat jouw public_key naar de agent wordt gezet. Deployer werkt namelijk via forward-agent.
- Voer `ssh-copy-id username@ip` uit om jezelf aan de known-hosts toe te voegen op de deployment server.
- Op dit moment wanneer je via `ssh username@ip` inlogd op de deployment server, wordt je niet meer om je wachtwoord gevraagd. - Zorg ervoor dat de deployment server ssh toegang heeft naar de repository. Dit kan via zogenaamde deployment-keys. Zie: https://developer.github.com/guides/managing-deploy-keys/.
- Start het deployen door `vendor/bin/dep deploy-yii [stage] -vvv` uit te voeren.
- Na de eerste keer zullen waarschijnlijk public_html symlinks moeten worden gemaakt. Link deze altijd naar de `current/frontend/web` folder die aangemaakt wordt tijdens deployment.

### Tips:
- In de example wordt een lokale config.yml meegestuurd via ssh. Er kan ook gekozen worden om deze eenmalig over te sturen via FTP en daarna in een systeem variabele te zetten waar de locatie is van dit bestand. Zie `common/config/main-local.php` voor meer info.
- Om meer configs toe te voegen in de `common/config/config.yml`, zorg er dan voor dat dit ook in de `environment/[stage]/common/config.yml.example`.
