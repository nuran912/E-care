<!DOCTYPE html>
<html>

<head>
   <style>
      /* CSS styles for the footer */
      .footer {
         /* position: absolute; */
         left: 0;
         bottom: 0;
         /* width: 100%; */
         background-color: #0E2F56;
         padding: 50px;
         color: #ffffff;
         /* text-align: center; */
         display: flex;
      }

      .footer-main {
         display: flex;
         flex-direction: column;
         width: 35%;
      }
      .follow-us span {
         font-size: 20px;
         
      }
      .footer-icons a{
         text-decoration: none;
         font-size: 20px;
         margin-left: 10px; 
      }
      .follow-us {
         display: flex;
         justify-content: space-between;
         align-items: center;
      }
      .footer-contact {
         margin-left: 5%;
      }
      .footer-contact b {
         font-size: 20px;
      }
      .footer-contact p {
         
         font-size: 13px;
         margin-left: 25px;
      }
      .footer-ximage {
         margin-left: 10%;
      }
      .footer-x {
        position: absolute;
        
      }
      #footer-x1 {
         margin: auto;
      }
      #footer-x2 {
         margin-top: 7%;
         margin-left: 15%;
      }
      #footer-x3 {
         margin-top: 14%;
         margin-left: 0%;
      }
      #footer-x4 {
         margin-top: 21%;
         margin-left: 15%;
      }


   </style>

</head>

<body>
   <div class="footer">
      <div class="footer-main">
         <?php include '../assets/icons/Logo_white.svg'; ?> <br>
         <?php include '../assets/icons/UNION_HOSPITAL_white.svg'; ?> <br><br>


         <p>Welcome to E-care, your trusted partner in digital healthcare
            management. Our innovative platform seamlessly connects
            patients, doctors, and healthcare providers, offering an all-in-one
            solution for appointments, medical records, and insurance claims.
            With E-care, managing your health is easier and more efficient
            than ever. Experience the future of healthcare, where your well-
            being is our priority
         </p>
         <br>
         <div class="follow-us">

            <span>FOLLOW US ON</span>
            <div class="footer-icons">
               
               <a href="https://www.facebook.com/unionhospital/" target="_blank">
                  <?php include '../assets/icons/Facebook.svg'; ?>
               </a>
               <a href="https://www.instagram.com/unionhospital/" target="_blank">
                  <?php include '../assets/icons/Instagram.svg'; ?>
               </a>
               <a href="https://twitter.com/unionhospital" target="_blank">
                  <?php include '../assets/icons/TwitterX.svg'; ?>
               </a>
               <a href="https://www.linkedin.com/company/unionhospital/" target="_blank">
                  <?php include '../assets/icons/LinkedIn.svg'; ?>
               </a>
            </div>
         </div>
         <p>&copy; 2021 E-Care. All rights reserved.</p>
      </div>

      <div class="footer-contact">
         <b>UNION HEALTH NETWORK</b> 
         <p>UNION MEDICAL</p>
         <p>UNION CENTRAL</p>
         <p>UNION SURGICAL</p>
         <br>
         <p>UNION LABORATORIES - RAJAGIRIYA</p>
         <p>UNION LABORATORIES - BAMBALAPITYA</p>
         <p>UNION LABORATORIES - DEHIWALA</p>

         <br>

         <b>CONTACT US</b>
         <p>Hotline - 011 245 9989</p>
         <p>Emergency 24/7 - 1234</p>

      </div>
      <div class="footer-ximage">
         <div class="footer-x" id="footer-x1"><?php include '../assets/icons/Xbox_Cross.svg'; ?></div>
         <div class="footer-x" id="footer-x2"><?php include '../assets/icons/Xbox_Cross.svg'; ?></div>
         <div class="footer-x" id="footer-x3"><?php include '../assets/icons/Xbox_Cross.svg'; ?></div>
         <div class="footer-x" id="footer-x4"><?php include '../assets/icons/Xbox_Cross.svg'; ?></div>
      

      </div>

      


   </div>
</body>

</html>