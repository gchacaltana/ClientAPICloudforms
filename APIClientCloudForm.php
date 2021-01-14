<?php

/**
 * API Client to access CloudForms Framework (to access resources Data Center)
 *
 * @author Gonzalo Chacaltana Buleje <gchacaltanab@gmail.com>
 * @version v1.2.0
 */
require_once APPPATH . 'third_party/dotenv/autoloader.php';

class APIClientCloudForm {

    /**
     *  @var string URL de API.
     *  @access private
     *  Valor obtenido de variable de entorno.
     *  Ejemplo: https://cloudforms.datacenter.pe/vmdbws/?wsdl
     */
    private $_urlWSDL = NULL;

    /**
     * @var string nombre de usuario del API Cloudforms
     * @access private
     * Valor obtenido de variable de entorno.
     */
    private $_user = NULL;

    /**
     * @var string contraseña de usuario del API Cloudforms
     * @access private
     * Valor obtenido de variable de entorno.
     */
    private $_password = NULL;

    /**
     * @var object Instancia de conexión de SoapClient
     * @access private
     */
    private $_client = null;

    /**
     * @var string tipo de enconding
     * @access private
     */
    private $_encoding = 'UTF-8';

    /**
     * @var array contiene array de información para devolver al consumidor.
     * @access private
     */
    private $_response = array();

    public function __construct() {
        $dotenv = new Dotenv\Dotenv(__DIR__ . "/../env");
        $dotenv->load();
        $this->_urlWSDL = getenv('API_URL');
        $this->_user = getenv('API_USER_NAME');
        $this->_password = getenv('API_USER_PSW');
        $options = array(
            'trace' => 1,
            'exceptions' => 0,
            'encoding' => $this->_encoding,
            'soapaction' => '',
            'login' => $this->_user,
            'password' => $this->_password
        );
        try {
            $this->_client = new soapClient($this->_urlWSDL, $options);
        } catch (SoapFault $ex) {
            echo sprintf("SoapFault: %s", $ex->getMessage());
        }
    }

    /**
     * @return json JSON format response
     */
    private function _returnResponse() {
        return json_encode($this->_response);
    }

    /**
     * Devuelve todas las máquinas virtuales.
     * @return array
     */
    public function getVirtualMachineList() {
        $this->_response = $this->_client->call('GetVmList', array("hostGuid" => "*"));
        return $this->_returnResponse();
    }

    /**
     * Devuelve información de una máquina virtual mediante su GUID.
     * @param string $guid GUID Virtual Machine. Example: 4cb6c43c-7241-11e3-802e-001a4a8405a3
     * @return array
     */
    public function getVirtualMachineByGUID(string $guid) {
        $this->_response = $this->_client->call('FindVmByGuid', array("vmGuid" => $guid));
        return $this->_returnResponse();
    }

    /**
     * Devuelve todos los hosts.
     * @return array
     */
    public function getHostList() {
        $this->_response = $this->_client->call('GetHostList', array("emsGuid" => "*"));
        return $this->_returnResponse();
    }

    /**
     * Devuelve información de un Host mediante su GUID.
     * @param string $host GUID Host. Example: 429a8973-3841-11e3-802e-001a4a9105a3
     * @return array
     */
    public function getHostByGUID(string $host) {
        $this->_response = $this->_client->call('FindHostByGuid', array("hostGuid" => $host));
        return $this->_returnResponse();
    }

    /**
     * Devuelve todos los clusters.
     * @return array
     */
    public function getClusterList() {
        $this->_response = $this->_client->call('GetClusterList', array("emsGuid" => "*"));
        return $this->_returnResponse();
    }

    /**
     * Devuelve información de un cluster mediante su ID.
     * @param int $clusterID ID Cluster. Example: 19812
     * @return array
     */
    public function getClusterByID(int $clusterID) {
        $this->_response = $this->_client->call('FindClusterById', array("clusterId" => $clusterID));
        return $this->_returnResponse();
    }

    /**
     * Devuelve todos los clusters.
     * @return array
     */
    public function getDataStoreList() {
        $this->_response = $this->_client->call('GetDatastoreList', array("emsGuid" => "*"));
        return $this->_returnResponse();
    }

    /**
     * Devuelve información de un cluster mediante su ID.
     * @param int $dataStoreID ID DataStore. Example: 254
     * @return array
     */
    public function getDataStoreByID(int $dataStoreID) {
        $this->_response = $this->_client->call('FindDatastoreById', array("datastoreId" => $dataStoreID));
        return $this->_returnResponse();
    }

}
