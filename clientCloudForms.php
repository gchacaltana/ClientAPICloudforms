/**
* Client API to access CloudForms.
* @author: Gonzalo Chacaltana Buleje <gchacaltanab@outlook.com>
*/
header('Content-Type: text/html; charset=utf-8');
require_once 'lib/nusoap.php';

(string) $url = "https://cloudforms.domain.pe/vmdbws/wsdl";
$user = "username";
$password = "securityPass";
$client = new nusoap_client($url, true);
$client->soap_defencoding = 'UTF-8';
$client->debug_flag = false;
$client->setCredentials($user, $password);

$err = $client->getError();
//var_dump($client->getDebug());
if ($err) {
    echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
}

//Information VMs.
$result = $client->call('GetVmList', array("hostGuid" => "*"));
$result = $client->call('FindVmByGuid', array("vmGuid" => "4cb6c43c-7241-11e3-802e-001a4a8405a3"));

//Information hosts.
$result = $client->call('GetHostList', array("emsGuid" => "*"));
$result = $client->call('FindHostByGuid', array('hostGuid' => "429a8973-3841-11e3-802e-001a4a9105a3"));

//Information clusters.
//$result = $client->call('GetClusterList', array('emsGuid' => '*'));
//$result = $client->call('FindClusterById', array('clusterId' => '1'));

//Information data stores.
//$result = $client->call('GetDatastoreList', array('emsGuid'=>'*'));
//$result = $client->call('FindDatastoreById', array('datastoreId'=>'18'));

print_r($result);
?>
