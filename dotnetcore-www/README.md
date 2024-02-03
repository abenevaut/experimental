Si visual studio a fait accepter le certificat mais qu'il n'est pas valide rejouer les commandes suivantes

```
PM > dotnet dev-certs https --clean
//Cleaning HTTPS development certificates from the machine. A prompt might get displayed to confirm the removal of some of the certificates.
//HTTPS development certificates successfully removed from the machine.

PM > dotnet dev-certs https --trust
//Trusting the HTTPS development certificate was requested.A confirmation prompt will be displayed if the certificate was not previously trusted.Click yes on the prompt to trust the certificate.
//Successfully created and trusted a new HTTPS certificate.

PM > dotnet dev-certs https --check
//A valid certificate was found: C40087E6CA2F2A811F3BF78E3C5FE6BA8FA2XXXX - CN = localhost - Valid from 2023 - 01 - 27 23:21:10Z to 2024 - 01 - 27 23:21:10Z - IsHttpsDevelopmentCertificate: true - IsExportable: true
//Run the command with both--check and --trust options to ensure that the certificate is not only valid but also trusted.
```