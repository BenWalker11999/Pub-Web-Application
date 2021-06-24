<footer class="page-footer bg-light">

<div class="container-fluid">
	<div class="row">
	<!-- If the user is not logged in the register button will display elsewise it wont -->
	<?php if(!$_SESSION['loggedin']){ ?>
		<div class="col-md">
			<ul>
				<li class="nav-item">
					<a class="nav-link" href="index.php?p=register">Register</a>
				</li>
			</ul>
		</div>
	<?php } ?>
		<div class="col-md">
			<ul>
			<!-- Hides the login button and displays the logout button when a user is logged in -->
			<?php if($_SESSION['loggedin']){ ?>
				<li class="nav-item">
					<a class="nav-link" href="index.php?p=logout">Log Out</a>
				</li>
			<?php }else{ ?>
				<li class="nav-item">
					<a class="nav-link" href="index.php?p=login">Sign In</a>
				</li>
			<?php } ?>
			</ul>
		</div>
		<div class="col-md">
			<ul>
				<li class="nav-item">
					<a class="nav-link" href="index.php?p=account">Your Account</a>
				</li>
			</ul>
		</div>
		<div class="col-md">
			<ul>
				<li class="nav-item">
					<a class="nav-link" href="index.php?p=add_pub">Add Pub</a>
				</li>
			</ul>
		</div>
		<div class="col-md">
			<ul>
				<li class="nav-item">
					<a class="nav-link" href="index.php?p=accessibility">Accessibility</a>
				</li>
			</ul>
		</div>
	</div>
</div>

</footer>

</body>
</html>