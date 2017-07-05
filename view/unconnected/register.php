<?php
	include('functions.php');

	if(isValidSubmit())
		addUser();
	else if((int) $_SERVER['CONTENT_LENGTH'] != 0)
		echo "Error.";

?>

<form method="POST" action="register.php">
	<input type="text" placeholder="First name" name="firstName" />				</br>
	<input type="text" placeholder="Last name" name="lastName" />				</br>
	<input type="password" placeholder="Password" name="password" />			</br>
	<input type="password" placeholder="Password" name="passwordChecker" />		</br>
	<input type="text" placeholder="Telephone" name="telephoneNumber" />		</br>
	<input type="text" placeholder="Address L1" name="addressL1" />				</br>
	<input type="text" placeholder="Address L2" name="addressL2" />				</br>
	<input type="text" placeholder="Address L3" name="addressL3" />				</br>
	<input type="text" placeholder="Zipcode" name="zipCode" />					</br>
	<input type="text" placeholder="Town" name="town" />						</br>
	<input type="text" placeholder="Country" name="country" />					</br>
	<input type="text" placeholder="EMail" name="email" />						</br>
	<input type="text" placeholder="EMail bis" name="email2" />					</br>
	<input type="text" placeholder="Birth date" name="birthDate" />				</br>
		Inscription news :
		<input type="radio" placeholder="Yes" value="true" name="inscriptionNews" checked /> Yes	
		<input type="radio" placeholder="No" value="false" name="inscriptionNews" /> No
		</br>
	<input type="submit" value="submit" />
</form>