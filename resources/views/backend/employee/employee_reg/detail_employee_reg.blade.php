
@php
    $position = '';
    foreach ($designations as $designation)
        if ($details['designation_id'] == $designation['id'])
            $position = $designation['name']
@endphp
<html>
	<head>
        <title>Employee Profile - {{ $details['name'] }}</title>
        <link href='http://fonts.googleapis.com/css?family=Rokkitt:400,700|Lato:400,300' rel='stylesheet' type='text/css'>
            <style>
                /*Define color of the theme*/
                :root {
                    --main-color:#925de3;
                }

                body {
                background: white;
                }

                page[size="A4"] {
                background: white;
                width: 21cm;
                height: 29.7cm;
                display: block;
                margin: 0 auto;
                margin-bottom: 0.0cm;
                box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
                }
                @media print {
                body, page[size="A4"] {
                    margin: 0;
                    box-shadow: 0;
                    }
                }


                .topBar {
                    padding: 25px 35px 10px;
                    border-bottom: 4px solid var(--main-color);
                    display: flex;
                    justify-content: space-evenly;
                }

                #photo {
                    width: 14.5%;
                    float: left;
                    margin-right: 30px;
                }
                .image_cropper {
                    vertical-align: middle;
                    width: 100px;
                    height: 100px;
                    position: relative;
                    overflow: hidden;
                    align-self: center;
                    border:5px solid var(--main-color);
                    border-radius: 200px;
                    -webkit-border-radius: 500px;
                    -moz-border-radius: 500px;
                }

                .icons{
                    width:16px;
                    height:16px;
                }

                #name h1 {
                    font-size: 2.5em;
                    font-weight: 500;
                    font-family: 'Rokkitt', Helvetica, Arial, sans-serif;
                    margin-bottom: -6px;
                }

                #name h2 {
                    font-size: 1.2em;
                    margin-left: 2px;
                    font-weight: 100;
                    font-family: 'Rokkitt', Helvetica, Arial, sans-serif;
                }

                #name {
                    float: left;
                }
                .contactDetails {
                    float: right;
                }

                #contactDetails ul {
                    list-style-type: none;
                    font-size: 0.8em;
                    margin-top: 2px;
                    text-align: right;
                }
                #contactDetails ul li {
                    margin-bottom: 3px;
                    color: #444;
                }
                #contactDetails ul li a, a[href^=tel] {
                    color: #444;
                    text-decoration: none;
                }


                #mainDocument {
                    padding: 0 40px;
                }

                section {
                    border-top: 1px solid #dedede;
                }

                section:first-child {
                    border-top: 0;
                }

                .sectionTitle{
                    font-family: 'Rokkitt', Helvetica, Arial, sans-serif;
                    font-size: 1.5em;
                    margin-bottom: -10px;
                    text-transform: uppercase;
                }

                .workContent{
                    margin-left: 20px;
                    margin-bottom: -10px;
                }

                .workTitle {
                    font-family: 'Rokkitt', Helvetica, Arial, sans-serif;
                    font-size: 1.4em;
                    font-style: bold;
                    margin-bottom: -10px;
                }

                .workCompany {
                    font-size: 0.8em;
                    margin-bottom: -10px;
                }
                .workDates {
                    font-size: 0.8em;
                    font-style: italic;
                    color: var(--main-color);
                    margin-bottom: -10px;
                    float: left;
                }

                .workLocation {
                    font-size: 0.8em;
                    font-style: italic;
                    color:  var(--main-color);
                    margin-bottom: -10px;
                    float: right;
                }
                .workDates {
                    font-size: 0.8em;
                    font-style: italic;
                    color: var(--main-color);
                    margin-bottom: -10px;
                    float: left;
                }

                .workBullets{
                    padding-left: 1.2em;
                    padding-bottom: 0.2em;
                }
                .workBullets li {
                    color: var(--main-color);
                    padding-left:0;
                    margin-bottom: -10px;
                }
                .workBullets p{
                    color: black;
                    font-size: 0.8em;
                }

                .eduContent{
                    margin-left: 20px;
                    margin-bottom: -10px;
                }

                .eduUni {
                    font-size: 0.8em;
                    margin-bottom: -10px;
                }
                .eduDates {
                    font-size: 0.8em;
                    font-style: italic;
                    color: var(--main-color);
                    margin-bottom: -10px;
                }

                .eduLocation {
                    font-size: 0.8em;
                    font-style: italic;
                    color:  var(--main-color);
                    margin-bottom: -10px;
                    float: right;
                }

                .eduBullets{
                    padding-left: 1.2em;
                    padding-bottom: 0.2em;
                }
                .eduBullets li {
                    color: var(--main-color);
                    padding-left:0;
                    margin-bottom: -10px;
                }
                .eduBullets p{
                    color: black;
                    font-size: 0.8em;
                }

                .keySkills {
                    list-style-type: none;
                    -moz-column-count:3;
                    -webkit-column-count:3;
                    column-count:3;
                    margin-bottom: 20px;
                    font-size: 1em;
                    color: #444;
                }

                .keySkills ul li {
                    margin-bottom: 3px;
                }


                .rectangle{
                    margin-left: -40px;
                    width:20px;
                    height:20px;
                    background: var(--main-color);
                    float: left;
                    vertical-align: bottom;
                }

                .otherSkills {
                    width:100%;
                    margin-top: 20px;
                }

                .otherSkills ul{
                    list-style: none;
                    font-size: 0.8em;
                }

                .languagesSection{
                    margin-bottom: -20px;
                }

                .languages {
                    width:100%;
                    margin-top: 20px;
                }

                .languages  ul{
                    list-style: none;
                }

                .otherInterests{
                    margin-left: 20px;
                    margin-top: 10px;
                }

                .otherInterests ul{
                    font-size: 0.8em;
                    list-style: none;
                }
                .personal-table {
                    width: 80%;
                    margin: 10px auto;
                }
                .table-title {
                    font-size: 1.1em;
                    font-weight: bold;
                    color: var(--main-color);
                    padding: 5px 0;
                    width: 25%;

                }
                .table-title-study {
                    font-size: 1.1em;
                    font-weight: bold;
                    background: var(--main-color);
                    padding: 5px 0;
                    width: 20%;
                    color: white;
                    text-align: center;
                }
            </style>
    </head>
    <body>
    <page size="A4"> <!-- Begin first page -->
        <!-- ==================================     TOP BAR    ================================== -->
        <div class="topBar">
            <div id="photo">
                <img src="{{  !empty($details['image'])  ? ('/upload/employee_images/'.$details['image']) : asset('upload/user3-128x128.jpg')  }}"  class="image_cropper">
            </div>

            <div id="name">
                <h1 class="">Employee Profile</h1>
                <h2 class="">
                    {{ $position }}
                </h2>
            </div>

            <div id="contactDetails" >
                <ul>
                    <li>Swallowtail School Management</li>
                    <li><a href="#" target="_blank" >www.school-management.com</a></li>
                    <li><a href="https://github.com/EmilRailgun" target="_blank">EmilRailgun</a></li>
                </ul>
            </div>
        </div>

        <div id="mainDocument">
            <section><!-- ==============================     STUDENT INFORMATION     ============================= -->
                <div class="section">
                    <h1 class="sectionTitle">INFORMATION</h1>
                    <article>
                        <div class="rectangle"></div>
                        <p class="workTitle">Personal Information</p>
                        <div class="workContent">
                            <table class="personal-table">
                                <tr>
                                    <td class="table-title">Name</td>
                                    <td>{{ $details['name'] }}</td>
                                </tr>
                                <tr>
                                    <td class="table-title">Gender</td>
                                    <td>{{ $details['gender'] }}</td>
                                </tr>
                                <tr>
                                    <td class="table-title">Date of Birht</td>
                                    <td>{{ $details['dob'] }}</td>
                                </tr>
                                <tr>
                                    <td class="table-title">Address</td>
                                    <td>{{ $details['address'] }}</td>
                                </tr>
                                <tr>
                                    <td class="table-title">Mobile Number</td>
                                    <td>{{ $details['mobile'] }}</td>
                                </tr>
                            </table>
                        </div>
                    </article>
                    <article>
                        <div class="rectangle"></div>
                        <p class="workTitle">Family</p>
                        <div class="workContent">
                            <table class="personal-table">
                                <tr>
                                    <td class="table-title">Father's Name</td>
                                    <td>{{ $details['fname'] }}</td>
                                </tr>
                                <tr>
                                    <td class="table-title">Mother's Name</td>
                                    <td>{{ $details['mname'] }}</td>
                                </tr>
                            </table>
                        </div>
                    </article>
                    <article>
                        <div class="rectangle"></div>
                        <p class="workTitle">Working</p>
                        <div class="workContent">
                            <table class="personal-table">
                                <tr>
                                    <td class="table-title">ID Number</td>
                                    <td>{{ $details['id_no'] }}</td>
                                </tr>
                                <tr>
                                    <td class="table-title">Joining Date</td>
                                    <td>{{ $details['join_date'] }}</td>
                                </tr>
                                <tr>
                                    <td class="table-title">Designation</td>
                                    <td>{{ $position }}</td>
                                </tr>
                                <tr>
                                    <td class="table-title">Salary</td>
                                    <td>{{ $details['salary'] }}</td>
                                </tr>
                            </table>
                        </div>
                    </article>
                </div>
            </section>
        </div>
    </page>

    </body>
</html>
