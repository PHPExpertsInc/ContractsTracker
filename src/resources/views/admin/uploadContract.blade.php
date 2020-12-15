<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload a Contract</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script
            src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
<style>
body {
    padding: 40px;
}
</style>
<script>
$(document).ready(function () {
    $('button#uploadContract').click(function() {
        const contractData = {
            name: $('input#contract_name').val(),
            description: $('input#contract_description').val(),
            contract: $('textarea#contract').text()
        };

        $.post('/contracts-tracker/api/contract', contractData)
            .then(function (data) {
                window.location.href = "/contracts-tracker/admin/contract/" + data.contractId;
            })
            .catch(function (error) {
                alert(data);
            });
    });
});
</script>
</head>
<body>
    <header>
        <h1>Upload a Contract</h1>
        <p>Please upload your contract here...</p>
        <p>It needs to be in the <a href="https://www.markdownguide.org/" target="_blank">Markdown format</a>.</p>
    </header>
    <section class="contract_meta">
        <form>
            <div class="form-group">
                <label for="contract_name"><strong>Contract Name</strong></label>
                <input type="text" class="form-control col-md-6" id="contract_name" aria-describedby="emailHelp" placeholder="Contract's name"
                value="Short NDA">
                <small id="emailHelp" class="form-text text-muted">This is how we will refer to the contract everywhere else.</small>
            </div>
            <div class="form-group">
                <label for="contract_description"><strong>Description</strong></label>
                <input type="text" class="form-control col-md-6" id="contract_description" placeholder="Briefly describe the contract's purpose."
                value="A non-wordy basic Non-Disclosure Agreement">
            </div>
        </form>
    </section>
    <section class="contract">
        <div><textarea id="contract" rows="22" cols="73">
State of Nevada

## APPRENTICESHIP NON-DISCLOSURE<br>AND CONFIDENTIALITY AGREEMENT

This Apprenticeship Non-Disclosure and Confidentiality Agreement (this “Agreement”) is entered into as of the **\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_, 20\_\_\_\_\_\_** (the “Effective Date”) by and between:

**Mentor:** **PHP Experts, Inc.**, a Corporation (the "Company")

**Applicant:** \_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_\_, an individual (the "Applicant").

The Company is considering Applicant for an **apprenticeship** with the Company and may disclose proprietary information unique and valuable to its ongoing business operations to Applicant during discussions with and evaluation of Applicant’s skills, abilities and suitability for the Position (the “Apprenticeship”). In consideration of the Company’s willingness to conduct the Apprenticeship and the covenants and mutual promises contained herein, the parties agree as follows:

**1.  Confidential Information.** Confidential information is: (Check one)

  *   **All information shared by the Company.** "Confidential Information" shall mean (i) all information relating to the Company’s products, business and operations including, but not limited to, financial documents and plans, customers, suppliers, manufacturing partners, marketing strategies, vendors, products, product development plans, technical product data, product samples, costs, sources, strategies, operations procedures, proprietary concepts, inventions, sales leads, sales data, customer lists, customer profiles, technical advice or knowledge, contractual agreements, price lists, supplier lists, sales estimates, product specifications, trade secrets, distribution methods, inventories, marketing strategies, non-open source source code, non-open source software,  data, drawings or schematics, blueprints, computer programs and systems and know-how or other intellectual property of the Company and its affiliates that may be at any time furnished, communicated or delivered by the Company to the Applicant, whether in oral, tangible, electronic or other form; (ii) the terms of any agreement, including this Agreement, and the discussions, negotiations and proposals related to any agreement; (iii) information acquired during any tours of the Company’s facilities; and (iv) all other non-public information provided by the Company whosoever. All Confidential Information shall remain the property of the Company.

  *   **'Intellectual Property'** which includes patents, trademarks, service marks, logos, trade names, internet or website domain names, rights in designs and schematics, copyrights (including rights in computer software), moral rights, database rights, in each case whether registered or unregistered and including applications for registration, in all rights or forms anywhere in the world.

  *   **Proprietary Teaching Techniques:** During the Apprenticeship, the Apprentice will be taught using Confidential Teaching Techniques and Strategies. Disclosure of non-public teaching materials, concepts and teaching strategies is strictly forbidden by this agreement.

2. **Exclusions from Confidential Information.** The obligation of confidentiality with respect to Confidential Information will not apply to any information:

   1. If the information is or becomes publicly known and available other than as a result of prior unauthorized disclosure by Applicant;

   2. If the information is or was received by Applicant from a third-party source which, to the best knowledge of Applicant, is or was not under a confidentiality obligation to the Company with regard to such information;

   3. If the information is disclosed by Applicant with the Company’s prior written permission and approval;

   4. If the information is independently developed by Applicant prior to disclosure by the Company and without the use and benefit of any of the Company’s Confidential Information; or

   5. If the Applicant may disclose only such portion of the Confidential Information which it is legally obligated to disclose Applicant is legally compelled by applicable law, by any court, governmental agency, or regulatory authority or subpoena or discovery request in pending litigation, but only if, to the extent lawful, Applicant gives prompt written notice of that fact to the Company prior to disclosure so that the Company may request a protective order or other remedy, Applicant may disclose only such portion of the Confidential Information which it is legally obligated to disclose.


IN WITNESS WHEREOF, the parties hereto have executed this Agreement as of the date first written above.

**Applicant** Full Name
________________________
**Applicant** Signature
________________________
**Date**
________________________


**Employer Representative** Name and Title
________________________   __________________
**Representative** Signature
________________________
**Date**
________________________


            </textarea></div>
        <div><button class="btn btn-primary" id="uploadContract">Upload</button></div>
    </section>
</body>
</html>
