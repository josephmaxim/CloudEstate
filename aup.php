<?php
//  Group #     : 15
//  Members     : Joseph Dagunan, David Bond, Alex Waddell
//  File name   : aup.php

// Page title
$title = "Cloud Estate | Home";

// Include header
include_once('header.php');
?>

    <div class="content">
        <div class="container">
            <?php
            if(isset($_COOKIE['disableMSG'])) {
                echo '<div class="alert alert-warning" role="alert">
                              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                              '.$_COOKIE['disableMSG'].'
                              </div>';
                setcookie("disableMSG", "");
            }
            ?>
            <h1>ACCEPTABLE USE POLICY</h1>

            <p>This Acceptable Use Policy document, including the following list of Prohibited Activities, is an integral part of your Hosting Agreement with Durham College Cloud Estate. If you engage in any of the activities prohibited by this AUP document Durham College Cloud Estate may suspend or terminate your account.</p>

            <p>Durham College Cloud Estate's Acceptable Use Policy (the &quot;Policy&quot;) for Durham College Cloud Estate Services is designed to help protect Durham College Cloud Estate, Durham College Cloud Estate's customers and the Internet community in general from irresponsible or, in some cases, illegal activities. The Policy is a non-exclusive list of the actions prohibited by Durham College Cloud Estate. Durham College Cloud Estate reserves the right to modify the Policy at any time, effective upon posting at http://url_to_AUP_policy.</p>

            <p>Prohibited Uses of Durham College Cloud Estate Systems and Services:</p>

            <p>1. Transmission, distribution or storage of any material in violation of any applicable law or regulation is prohibited. This includes, without limitation, material protected by copyright, trademark, trade secret or other intellectual property right used without proper authorization, and material that is obscene, defamatory, constitutes an illegal threat, or violates export control laws.</p>

            <p>2. Sending Unsolicited Bulk Email (&quot;UBE&quot;, &quot;spam&quot;). The sending of any form of Unsolicited Bulk Email through Durham College Cloud Estate's servers is prohibited. Likewise, the sending of UBE from another service provider advertizing a web site, email address or utilizing any resource hosted on Durham College Cloud Estate's servers, is prohibited. Durham College Cloud Estate accounts or services may not be used to solicit customers from, or collect replies to, messages sent from another Internet Service Provider where those messages violate this Policy or that of the other provider.</p>

            <p>3. Running Unconfirmed Mailing Lists. Subscribing email addresses to any mailing list without the express and verifiable permission of the email address owner is prohibited. All mailing lists run by Durham College Cloud Estate customers must be Closed-loop (&quot;Confirmed Opt-in&quot;). The subscription confirmation message received from each address owner must be kept on file for the duration of the existence of the mailing list. Purchasing lists of email addresses from 3rd parties for mailing to from any Durham College Cloud Estate-hosted domain, or referencing any Durham College Cloud Estate account, is prohibited.</p>

            <p>4. Advertising, transmitting, or otherwise making available any software, program, product, or service that is designed to violate this AUP or the AUP of any other Internet Service Provider, which includes, but is not limited to, the facilitation of the means to send Unsolicited Bulk Email, initiation of pinging, flooding, mail-bombing, denial of service attacks.</p>

            <p>5. Operating an account on behalf of, or in connection with, or reselling any service to, persons or firms listed in the Spamhaus Register of Known Spam Operations (ROKSO) database at www.spamhaus.org/rokso.</p>

            <p>6. Unauthorized attempts by a user to gain access to any account or computer resource not belonging to that user (e.g., &quot;cracking&quot;).</p>

            <p>7. Obtaining or attempting to obtain service by any means or device with intent to avoid payment.</p>

            <p>8. Unauthorized access, alteration, destruction, or any attempt thereof, of any information of any Durham College Cloud Estate customers or end-users by any means or device.</p>

            <p>9. Knowingly engage in any activities designed to harass, or that will cause a denial-of-service (e.g., synchronized number sequence attacks) to any other user whether on the Durham College Cloud Estate network or on another provider's network.</p>

            <p>10. Using Durham College Cloud Estate's Services to interfere with the use of the Durham College Cloud Estate network by other customers or authorized users.</p>

            <p>
                Customer Responsibility for Customer's Users</p>

            <p>Each Durham College Cloud Estate customer is responsible for the activities of its users and, by accepting service from Durham College Cloud Estate, is agreeing to ensure that its customers/representatives or end-users abide by this Policy. Complaints about customers/representatives or end-users of an Durham College Cloud Estate customer will be forwarded to the Durham College Cloud Estate customer's postmaster for action. If violations of the Durham College Cloud Estate Acceptable Use Policy occur, Durham College Cloud Estate reserves the right to terminate services with or take action to stop the offending customer from violating Durham College Cloud Estate's AUP as Durham College Cloud Estate deems appropriate, without notice.</p>

            <p>Last Modified: Mon, 05 Dec 16 03:41:08 +0000</p>
        </div>
    </div>

<?php
// Include footer
include_once('footer.php');
?>