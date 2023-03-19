<?php include('header.php'); ?>
    <div class="container">
      <div class="py-5 text-center">
        <h2>Payment Form</h2>
      </div>
      <fieldset>
      <form method="post" name="customerData" action="ccavRequestHandler.php">
          <p>
            <!-- <label for="tid"> Transaction ID</label> -->
            <!--<input type="hidden" class="form-control" name="tid" id="tid" value="<?php echo(rand(11111,99999)); ?>" readonly required />-->
            <input type="hidden" class="form-control" name="tid" id="tid" value="76072156" readonly required />
          </p>
          <p>
            
            <input type="hidden" class="form-control" name="order_id" id="order_id" value="<?php echo(rand(11111,99999)); ?>" readonly required />
          </p>
          <p>
          <input  type="hidden" name="merchant_id" value="2071243"/>
          </p>

          <p style="display:none" >
            <label for="currency">Original Currency </label>
        <select class="form-select" name="currency" aria-label="Default select example" >
  
            <option value="INR" selected='true'>Indian Rupees</option>
                <option value="USD">US Dollar</option>
              
            </select>
          </p>
          <!-- for dummy fields -->
          <p>
            <label for="currency_dumy"> Currency </label>
        <select class="form-select" name="currency_dummy" aria-label="Default select example" id ="currencyBlock">
  
            <option value="INR" selected='true'>Indian Rupees (INR)</option>
                <option value="USD">US Dollar (USD)</option>
             
            </select>
          </p>
            <label for="change"id="changed_amount" style="display: none;"> Amount in USD </label>
          <p >
            <input type="hidden"  class="form-control" name="changed_amount" placeholder="Enter Amount" id="currency-one" required />
          </p>
          <p>
            <label for="amount"> Amount in INR </label>
            <input type="number"  class="form-control" name="amount"  id="currency-two"  required/>
          </p>
          <p>
            <label for="paying"> Paying For </label>
            <input type="text"  class="form-control" name="merchant_param1"  placeholder="Enter Payment Details " required/>
          </p>

         
          <p>
            <input type="hidden"  class="form-control" name="redirect_url" value="http://localhost/code/presude_converter/ccavResponseHandler.php" />
          </p>
          <p>
            <input type="hidden"  class="form-control" name="cancel_url" value="http://localhost/code/presude_converter/ccavRequestHandler.php" />
          </p>
          <p>
            <input type="hidden"  class="form-control" name="language" value="EN" />
          </p>
          <h3 for="name"> Billing Information: </h3>
          <p>
              <label for="name"> Name </label>
            <input type="text"  class="form-control" name="billing_name" placeholder="Mention your name" required />
          </p>
          <p>
              <label for="address"> Address </label>
            <input type="text"  class="form-control" name="billing_address" placeholder="Mention your address"/>
          </p>
          <p>
              <label for="city"> City </label>
            <input type="text"  class="form-control" name="billing_city" placeholder="Mention city name"/>
          </p>
          <p>
              <label for="state"> State </label>
            <input type="text"  class="form-control" name="billing_state" Placeholder="Mention state name"/>
          </p>
          <p>
              <label for="pin"> Pincode </label>
            <input type="text"  class="form-control" name="billing_zip" placeholder="Mention Zipcode"/>
          </p>
          <p>
              <label for="country"> Country </label>
            <input type="text"  class="form-control" name="billing_country" placeholder="Mention country name"/>
          </p>
          <p>
            <label for="email"> Email</label>
            <input type="email"  class="form-control"  name="billing_email" placeholder="Mention your email id" required/>
          </p>
          <p>
            <label for="phone"> Phone</label>
            <input type="number"  class="form-control" name="billing_tel" placeholder="Mention contact number" required required />
          </p>
          
          
          <p>&nbsp;</p>
          <p>
            <input TYPE="submit" class="btn btn-primary" value="SUBMIT" />
          
          </p>
        </form>
        
      </fieldset>
    </div>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
    crossorigin="anonymous"
  ></script>
  <script src="app.js"></script>
  <script>
    const currencyEl_one = document.getElementById('currency-one');
    const currencyEl_two = document.getElementById('currency-two');

 // Fetch exchange rates and update the dome
 currencyEl_one.addEventListener('change', (()=>{
   console.log("running");
  
    let amount = currencyEl_one.value;
    let to = "INR";
    let from = "USD";
    var myHeaders = new Headers();
   myHeaders.append("apikey", "kCMxUKoaGB4dvMVZY0iO4UMNux9hci7L");
   
   var requestOptions = {
     method: "GET",
     redirect: "follow",
     headers: myHeaders,
   };
   
   fetch(
     `https://api.apilayer.com/exchangerates_data/convert?to=${to}&from=${from}&amount=${amount}`,
     requestOptions
   )
     .then((response) => response.text())
     .then((result) => {
       let data = JSON.parse(result);
      //  console.log(data.result);
       console.log(data);
       currencyEl_two.value = data.result;
     })
     .catch((error) => console.log("error", error));  
  }));
  </script>
<?php include('footer.php'); ?>
