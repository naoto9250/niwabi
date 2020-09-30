/**
 * 予約ページ 宿泊人数チェック
 */
jQuery('.wpcf7-form').submit(function(){
  // #total-errorを初期化
  jQuery("#total-error").html("");
  
  // 男性の人数を取得
  let maleNum = document.getElementById( 'men-num' );
  let selectedMale = maleNum.options[ maleNum.selectedIndex ];

  // 女性の人数を取得
  let femaleNum = document.getElementById( 'women-num' );
  let selectedFemale = femaleNum.options[ femaleNum.selectedIndex ];

  // 合計を計算
  let totalNum = Number(selectedMale.value) + Number(selectedFemale.value);

  // 合計人数が異なる場合エラーメッセージ表示
  let poepleNum = document.getElementById( 'poeple-num' );
  let selectedTotal = poepleNum.options[ poepleNum.selectedIndex ];

  if(totalNum != Number(selectedTotal.value)) {
    jQuery("#total-error").html("合計人数に間違いがあります。");
  }

  //submit中止
  return false;
});


/**
 * SPスライドメニュー
 */
const btn = document.querySelector('#nav-slide');
const nav = document.getElementById('navbarNavSlide');
const navCloseBtn = '<button class="nav-close"></button>';
 
btn.addEventListener('click', () => {
  nav.classList.toggle('open-menu');
});
// 閉じるボタン
nav.insertAdjacentHTML('afterbegin', navCloseBtn);
// 閉じるボタン・背景部分をタップしたらメニューを閉じる