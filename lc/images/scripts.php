			var modalWindow = {
				_block: null,
				_win: null,
		
				initBlock: function() {
					_block = document.getElementById('blockscreen'); 

					
					if (!_block) {
						var parent = document.getElementsByTagName('body')[0]; 
						var obj = parent.firstChild; 
						_block = document.createElement('div'); 
						_block.id = 'blockscreen';
						parent.insertBefore(_block, obj); 
						_block.onclick = function() { modalWindow.close(); } 
					}
					_block.style.display = 'inline';     
				},

				initWin: function(width, html) {
					_win = document.getElementById('modalwindow'); 
					
					if (!_win) {
						var parent = document.getElementsByTagName('body')[0];
						var obj = parent.firstChild;
						_win = document.createElement('div');
						_win.id = 'modalwindow';
						parent.insertBefore(_win, obj);
					}
					_win.style.width = width + 'px'; 
					_win.style.display = 'inline'; 
				
					_win.innerHTML = html; 
				
					

					_win.style.left = '50%';
					_win.style.top = '50%'; 

					
					_win.style.marginTop = -(_win.offsetHeight / 2) + 'px'; 
					_win.style.marginLeft = -(width / 2) + 'px';
				},

				close: function() {
					document.getElementById('blockscreen').style.display = 'none';
					document.getElementById('modalwindow').style.display = 'none';        
				},

				show: function(width, html) {
					modalWindow.initBlock();
					modalWindow.initWin(width, html);
				}
			}
			<?php if(isset($mmesage)) { ?>
			window.onload = function(){
			modalWindow.show(300, '<?=$mmesage ?>');
			}
			<?php } ?>