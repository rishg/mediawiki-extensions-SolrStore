<?php
# SolrStore
include_once("$IP/extensions/SolrStore/SolrConnector.php");
$smwgDefaultStore = "SolrConnectorStore";
$wgSolrUrl = 'http://localhost:8080/solr/sofis';

//You should uncomment this, until you have written your own. For Template questions ask Sascha
$wgSolrTemplate = "_FIS";

//This array includes all namespaces that you don’t want to be indexed. 
//Currently the SolrStore doesn’t work with the Advanced Search and the “Search in namespaces” feature. 
//We have used css to hide that feature for the SOFISwiki.
$wgSolrOmitNS = array(1,2,3,4,5,6,7,8,9,10,11,13,14,15,102,106);

//This is to disable the “Did you mean ….” Feature. I recommend you to turn it off if you use $wgSolrFields 
//with extra query parameters like  “AND category:Projects”, because it will always recommend you the page “Projects”.
$wgSolrShowRelated = false;

//Turning this on will probably help you. SolrStore will now print the url he uses for search querys 
//e.g. http://sofis.gesis.org:8080/solr/sofis/select/?q=*%3A*&version=2.2&start=0&rows=10&indent=on
$wgSolrDebug = false;


//The Last 3 are Optional, we use the “Additional Query string” for searching in just one Category. 
//You can switch between AND and OR Logic. If you want to switch this for all your querys, 
//than you have to change <solrQueryParser defaultOperator="AND"/> in your schema.xml.
//I don’t know exactly how Sascha implemented the Sorting Options, but I think it’s just the Fieldname and the sort order. 
//You can’t sort dynamic Fields with this, because of a restriction from Solr. But there is a workaround for that. 
//You can define a CopyFields in your Schema.xml and Copy an dynamic Field in this static Field (dynamic Fields are created by runtime like a attributes. 
//Static Fields are all Fields defined in your Schema.xml like pagename). 

//new SolrSearchFieldSet('<Name of the SearchFieldSet>', '<List of Fields/Attributes>', <Labels for your Fields>', '<Additional querystring added to the end of your Search query>', '<AND / OR >', '<Sorting Options>')
$wgSolrFields = array(
    new SolrSearchFieldSet('Projekte', 'titleCombi;Institution_s; Personen; Id_s', 'Titel(stichworte); Institutionen; Personen; SOFIS-Nr. (Erfassungsnr.)', ' AND category:Projekte', 'AND'),
    new SolrSearchFieldSet('Institutionen', 'institutionCombi; Inst-ID;ort;Land', 'Institution(sstichworte); SOFIS-Institutions-Nr.;Ort;Land', ' AND category:Institution', 'AND', 'pagetitle asc')
);

?>