<?php
    require "header.php";
    
?>
        
	<section id="gallery">
		<figure class="picture">
			<img src="img/index/1.jpg">
		</figure>
		<figure class="picture">
			<img src="img/index/121.jpg">
		</figure>
		<figure class="picture">
			<img src="img/index/122.jpg">
		</figure>
		<footer id="dot-container">
			<h2>Намери красота във ВСИЧКО което виждаш...</h2>
			<div class="dot active" onclick="currentPicture(0)"></div>
			<div class="dot active" onclick="currentPicture(1)"></div>
			<div class="dot active" onclick="currentPicture(2)"></div>
		</footer>
	</section>

	<div id="teaser">
		<h1>⯆ Хвърли един поглед на най-новите постове ⯆</h1>
	</div>

	<main id="main-content">
	
		<section id="blogs">
			<article>
				<header>
					<h2>Джейк Фелпс почина на 56 - главния редактор на Трашър, истински скейтбординг Гуру</h2>
					<div>
						от <a href="#">Уилл Смит</a> на 05 Май, 2020
					</div>
				</header>
				<p>Джейк Фелпс, хапливия, забавен и стремителен дългогодишен редактор на най-почитаното скейтбординг списание, Трашър, позиция която го направи близък с култура позната с разпри от страна на властите, бе намерен мъртър на 13 Март...</p>
				<footer>
					<a href="blogs.php">Продължи с четенето →</a>
				</footer>
			</article>
			<article>
				<header>
					<h2>Бинг Лу вижда скейтбординга като инструмент за живота</h2>
					<div>
						от <a href="#">Джей Кан</a> на 19 юни, 2020
					</div>
				</header>
				<p>Имах особени затруднения с опитите да обесня твоето скорошно изследване , “Minding the Gap,” на мойте приятели. За какво мислиш че е? Мъча се с това. Когато за пръв път навлязохме в Сандукан и трябваше да напишем въведение, се опитвахме много здраво да не включим...</p>
				<footer>
					<a href="blogs.php">Продължи с четенето →</a>
				</footer>
			</article>
		</section>

		<section id="products">
			<div id="items">
				
				<figure>
					<img src="img/index/board1.png">
					<figcaption><a href="products.php">Виж още</a></figcaption>
				</figure>
				<figure>
					<img src="img/index/board1.png">
					<figcaption><a href="products.php">Виж още</a></figcaption>
				</figure>
				<figure>
					<img src="img/index/board1.png">
					<figcaption><a href="products.php">Виж още</a></figcaption>
				</figure>
				
			</div>
		</section>     
    </main>

	<!-- this script handles the custom carousel for the image gallery -->
    <script type="text/javascript" src="js/galleryScript.js"></script>

	<!-- this script handles the rendering of feedback messages -->
	<script type="text/javascript" src="js/renderHandler.js"></script>

	<?php
        if(isset($_SESSION['feedback-success'])){
            echo "<script>notifySuccess('".$_SESSION['feedback-success']."')</script>";
            unset($_SESSION['feedback-success']);
        }
        if(isset($_SESSION['feedback-failure'])){
            echo "<script>notifyFailure('".$_SESSION['feedback-failure']."')</script>";
            unset($_SESSION['feedback-failure']);
        }
    ?>

<?php
    require "footer.php";
?>