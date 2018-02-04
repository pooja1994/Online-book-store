<?php
/**
 * Example eWAY Rapid 3.1 Responsive Shared Page
 *
 * This page demonstrates how to use eWAY's Rapid 3.1 API
 * to complete a tranasaction using the Responsive Shared Page.
 *
 * THIS SCRIPT IS INTENDED AS AN EXAMPLE ONLY
 *
 * @see https://eway.io/api-v3/#responsive-shared-page
 */


// Include RapidAPI Library
require('../../lib/eWAY/RapidAPI.php');

$in_page = 'before_submit';
if (isset($_POST['btnSubmit'])) {
	
	

$demo=$_POST["demoaa"];
$demo1=$_POST["demo1"];

$chitid1=$_POST["chitid1"];
$chitamt=$_POST["chitamt"];
$maxchitmnt=$_POST["maxmonth"];

$maxchitmnt=$maxchitmnt-1;



// we skip all validation but you should do it in real world

// Create Responsive Shared Page Request Object
$request = new eWAY\CreateAccessCodesSharedRequest();

// Populate values for Customer Object
// Note: TokenCustomerID is Required Field When Update an exsiting TokenCustomer
if(!empty($_POST['txtTokenCustomerID'])) {
$request->Customer->TokenCustomerID = $_POST['txtTokenCustomerID'];
    }

    $request->Customer->Reference = $_POST['txtCustomerRef'];
    $request->Customer->Title = $_POST['ddlTitle'];
    $request->Customer->FirstName = $_POST['txtFirstName'];
    $request->Customer->LastName = $_POST['txtLastName'];
    $request->Customer->CompanyName = $_POST['txtCompanyName'];
    $request->Customer->JobDescription = $_POST['txtJobDescription'];
    $request->Customer->Street1 = $_POST['txtStreet'];
    $request->Customer->City = $_POST['txtCity'];
    $request->Customer->State = $_POST['txtState'];
    $request->Customer->PostalCode = $_POST['txtPostalcode'];
    $request->Customer->Country = $_POST['txtCountry'];
    $request->Customer->Email = $_POST['txtEmail'];
    $request->Customer->Phone = $_POST['txtPhone'];
    $request->Customer->Mobile = $_POST['txtMobile'];
    $request->Customer->Comments = $_POST['txtComments'];
    $request->Customer->Fax = $_POST['txtFax'];
    $request->Customer->Url = $_POST['txtUrl'];

    // Populate values for ShippingAddress Object.
    // This values can be taken from a Form POST as well. Now is just some dummy data.
    $request->ShippingAddress->FirstName = "John";
    $request->ShippingAddress->LastName = "Doe";
    $request->ShippingAddress->Street1 = "9/10 St Andrew";
    $request->ShippingAddress->Street2 = " Square";
    $request->ShippingAddress->City = "Edinburgh";
    $request->ShippingAddress->State = "";
    $request->ShippingAddress->Country = "gb";
    $request->ShippingAddress->PostalCode = "EH2 2AF";
    $request->ShippingAddress->Email = "your@email.com";
    $request->ShippingAddress->Phone = "0131 208 0321";
    // ShippingMethod, e.g. "LowCost", "International", "Military". Check the spec for available values.
    $request->ShippingAddress->ShippingMethod = "LowCost";

    if ($_POST['ddlMethod'] == 'ProcessPayment' || $_POST['ddlMethod'] == 'Authorise' || $_POST['ddlMethod'] == 'TokenPayment') {
        // Populate values for LineItems
        $item1 = new eWAY\LineItem();
        $item1->SKU = "SKU1";
        $item1->Description = "Description1";
        $item2 = new eWAY\LineItem();
        $item2->SKU = "SKU2";
        $item2->Description = "Description2";
        $request->Items->LineItem[0] = $item1;
        $request->Items->LineItem[1] = $item2;

        // Populate values for Payment Object
        $request->Payment->TotalAmount = $_POST['txtAmount'];
        $request->Payment->InvoiceNumber = $_POST['txtInvoiceNumber'];
        $request->Payment->InvoiceDescription = $_POST['txtInvoiceDescription'];
        $request->Payment->InvoiceReference = $_POST['txtInvoiceReference'];
        $request->Payment->CurrencyCode = $_POST['txtCurrencyCode'];
    }

    // Populate values for Options (not needed since it's in one script)
    $opt1 = new eWAY\Option();
    $opt1->Value = $_POST['txtOption1'];
    $opt2 = new eWAY\Option();
    $opt2->Value = $_POST['txtOption2'];
    $opt3 = new eWAY\Option();
    $opt3->Value = $_POST['txtOption3'];

    $request->Options->Option[0]= $opt1;
    $request->Options->Option[1]= $opt2;
    $request->Options->Option[2]= $opt3;

    // Build redurect & cancel URLs
    $self_url = 'http';
	$self1='/chits/';
    if (!empty($_SERVER['HTTPS'])) {$self_url .= "s";}
    $self_url .= "://" . $_SERVER["SERVER_NAME"];
    if ($_SERVER["SERVER_PORT"] != "80") {
        $self_url .= ":".$_SERVER["SERVER_PORT"];
    }
    $self_url .= $_SERVER["REQUEST_URI"];

    $request->RedirectUrl = $self_url;
    $request->CancelUrl   = $self_url;
    $request->Method = $_POST['ddlMethod'];
    $request->TransactionType = $_POST['ddlTransactionType'];

    $request->LogoUrl = $_POST['txtLogoUrl'];
    $request->HeaderText = $_POST['txtHeaderText'];
    $request->CustomView = $_POST['txtTheme'];
    $request->CustomerReadOnly = true;

    if ($_POST['txtVerifyMobile']) $request->VerifyCustomerPhone = true;
    if ($_POST['txtVerifyEmail']) $request->VerifyCustomerEmail = true;

    // Call RapidAPI
    $eway_params = array();
    if ($_POST['ddlSandbox']) $eway_params['sandbox'] = true;
    $service = new eWAY\RapidAPI($_POST['APIKey'], $_POST['APIPassword'], $eway_params);
    $result = $service->CreateAccessCodesShared($request);

    // Check if any error returns
    if(isset($result->Errors)) {
        // Get Error Messages from Error Code.
        $ErrorArray = explode(",", $result->Errors);
        $lblError = "";
        foreach ( $ErrorArray as $error ) {
            $error = $service->getMessage($error);
            $lblError .= $error . "<br />\n";
        }
    } else {
        $_SESSION['eWAY_key'] = $_POST['APIKey'];
        $_SESSION['eWAY_password'] = $_POST['APIPassword'];
        $_SESSION['eWAY_sandbox'] = $_POST['ddlSandbox'];

        header("Location: " . $result->SharedPaymentUrl);
        exit();
    }
}

if ( isset($_GET['AccessCode']) ) {
    $AccessCode = $_GET['AccessCode'];
    // should be somewhere from config instead of SESSION
    if ($_SESSION['eWAY_key'] && $_SESSION['eWAY_password']) {
        // Call RapidAPI
        $eway_params = array();
        if ($_SESSION['eWAY_sandbox']) $eway_params['sandbox'] = true;
        $service = new eWAY\RapidAPI($_SESSION['eWAY_key'], $_SESSION['eWAY_password'], $eway_params);

        $request = new eWAY\GetAccessCodeResultRequest();
        $request->AccessCode = $AccessCode;
        $result = $service->GetAccessCodeResult($request);

        $in_page = 'view_result';
        if (isset($result->Errors)) {
            $ErrorArray = explode(",", $result->Errors);
            $lblError = "";
            foreach ( $ErrorArray as $error ) {
                $error = $service->getMessage($error);
                $lblError .= $error . "<br />\n";
            }
        }
    }
}

?>
