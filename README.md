# Cliente API CloudForms

Cliente para obtener información de los recursos de un Data Center mediante el API del framework Cloudforms de Red Hat.

Comunicación mediante SOAP Web Services. Desarrollado en PHP 7.2 + SoapClient + API Cloudforms.

| Método | Descripción|
|--------|------------|
| getVirtualMachineList | Obtener lista de máquinas virtuales|
| getVirtualMachineByGUID | Obtener información de una máquina virtual mediante su GUID.|
| getHostList | Obtener lista de host servers |
| getHostByGUID | Obtener información de host server mediante su GUID |
| getClusterList | Obtener lista de clústers |
| getClusterByID | Obtener información de un clúster mediante su ID |
| getDataStoreList | Obtener lista de data storage |
| getDataStoreByID | Obtener información de un data storage mediante su ID |
