<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 

// 사용자 화면 우측과 하단을 담당하는 페이지입니다.
// 우측, 하단 화면을 꾸미려면 이 파일을 수정합니다.
?>		<footer id="main_footer">
			<nav id="main_fnb">
				<ul>
					<li><a href="#">개인정보 취급방침</a></li>
					<li>|</li>
					<li><a href="#">온라인 이용약관</a></li>
					<li>|</li>
					<li><a href="#">대규모 소매업고시</a></li>
					<li>|</li>
					<li><a href="#">마일리지 이용가이드</a></li>
				</ul>
			</nav>
			<figure>
				<label>
					<span id="address"><?=$config[cf_6]?></span>
					<span id="capyright"><?=$config[cf_5]?></span>
					<br>
					<span id="etc"><?=$config[cf_7]?></span>
				</label>
			</figure>
		</footer>
	</article>
</div>
		
<?
include_once("$g4[path]/tail.sub.php");
?>