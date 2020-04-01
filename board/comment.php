<?php
	$sql = 'select * from comment_free where co_no=co_order and b_no=' . $bNo;
	$result = $db->query($sql);
?>
<div id="commentView">
	<form action="/board/comment_update.php" method="post">
		<input type="hidden" name="bno" value="<?php echo $bNo?>">
		<?php
			while($row = $result->fetch_assoc()) {
		?>
		<ul class="oneDepth">
			<li>
				<div id="co_<?php echo $row['co_no']?>" class="commentSet">
					<div class="commentInfo">
						<div class="commentId">작성자: <span class="coId"><?php echo $row['co_id']?></span></div>
						<div class="commentBtn">
							<a href="#" class="comt write">댓글</a>
							<a href="#" class="comt modify">수정</a>
							<a href="#" class="comt delete">삭제</a>
						</div>
					</div>
					<div class="commentContent"><?php echo $row['co_content']?></div>
				</div>
				<?php
					$sql2 = 'select * from comment_free where co_no!=co_order and co_order=' . $row['co_no'];
					$result2 = $db->query($sql2);

					while($row2 = $result2->fetch_assoc()) {
				?>
				<ul class="twoDepth">
					<li>
						<div id="co_<?php echo $row2['co_no']?>" class="commentSet">
							<div class="commentInfo">
								<div class="commentId">작성자:  <span class="coId"><?php echo $row2['co_id']?></span></div>
								<div class="commentBtn">
									<a href="#" class="comt modify">수정</a>
									<a href="#" class="comt delete">삭제</a>
								</div>
							</div>
							<div class="commentContent"><?php echo $row2['co_content'] ?></div>
						</div>
					</li>
				</ul>
				<?php
					}
				?>
			</li>
		</ul>
		<?php } ?>
	</form>
</div>
<form action="comment_update.php" method="post">
	<input type="hidden" name="bno" value="<?php echo $bNo?>">
	<table>
		<tbody>
			<tr>
				<th scope="row"><label for="coId">아이디</label></th>
				<td><input type="text" name="coId" id="coId"></td>
			</tr>
			<tr>
				<th scope="row">
			<label for="coPassword">비밀번호</label></th>
				<td><input type="password" name="coPassword" id="coPassword"></td>
			</tr>
			<tr>
				<th scope="row"><label for="coContent">내용</label></th>
				<td><textarea name="coContent" id="coContent"></textarea></td>
			</tr>
		</tbody>
	</table>
	<div class="btnSet">
		<input type="submit" value="코멘트 작성">
	</div>
</form>
