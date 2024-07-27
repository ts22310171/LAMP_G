<?php
/*!
@file login.php
@brief �����o�[���O�C��
@copyright Copyright (c) 2024 Yamanoi Yasushi.
*/
if (!isset($_SESSION)) {
  session_start();
}

//���C�u�������C���N���[�h
require_once("../common/libs.php");

/* ���Ƀ��O�C�����Ă���ꍇ�A�_�b�V���{�[�h�փ��_�C���N�g */
if (isset($_SESSION['client']['name'])) {
  header('Location: message_list.php');
  exit();
}

$err_array = array();
$err_flag = 0;
$page_obj = null;

$ERR_STR = "";
$client_id = "";
$client_name = "";


//--------------------------------------------------------------------------------------
///	�{�̃m�[�h
//--------------------------------------------------------------------------------------
class cmain_node extends cnode
{
  //--------------------------------------------------------------------------------------
  /*!
	@brief	�R���X�g���N�^
	*/
  //--------------------------------------------------------------------------------------
  public function __construct()
  {
    //�e�N���X�̃R���X�g���N�^���Ă�
    parent::__construct();
  }
  //--------------------------------------------------------------------------------------
  /*!
	@brief  �{�̎��s�i�\���O�����j
	@return �Ȃ�
	*/
  //--------------------------------------------------------------------------------------
  public function execute()
  {
    global $ERR_STR;
    global $client_id;
    global $client_name;
    if (isset($_SESSION['client']['err']) && $_SESSION['client']['err'] != "") {
      $ERR_STR = $_SESSION['client']['err'];
    }
    //���̃Z�b�V�������N���A
    $_SESSION['client'] = array();

    if (isset($_POST['login']) && isset($_POST['password'])) {
      if ($this->chk_login(
        strip_tags($_POST['login']),
        strip_tags($_POST['password'])
      )) {
        $_SESSION['client']['login'] = strip_tags($_POST['login']);
        $_SESSION['client']['id'] = $client_id;
        $_SESSION['client']['name'] = $client_name;
        cutil::redirect_exit("message_list.php");
      }
    }
  }
  //--------------------------------------------------------------------------------------
  /*!
	@brief	�\�z���̏���(�p�����Ďg�p)
	@return	�Ȃ�
	*/
  //--------------------------------------------------------------------------------------
  public function create()
  {
  }
  //--------------------------------------------------------------------------------------
  /*!
	@brief	���O�C���̃`�F�b�N
	@return	�����o�[ID
	*/
  //--------------------------------------------------------------------------------------
  function chk_login($login, $password)
  {
    global $ERR_STR;
    global $client_id;
    global $client_name;
    $client = new cclient();
    $row = $client->get_tgt_login(false, $login);
    if ($row === false || !isset($row['login'])) {
      $ERR_STR .= "���[���A�h���X���s��ł��B\n";
      return false;
    }
    //�Í����ɂ��p�X���[�h�F��
    if (!cutil::pw_check($password, $row['password'])) {
      $ERR_STR .= "�p�X���[�h������Ă��܂��B\n";
      return false;
    }
    $client_id = $row['id'];
    $client_name = $row['name'];
    return true;
  }

  //--------------------------------------------------------------------------------------
  /*!
	@brief  �\��(�p�����Ďg�p)
	@return �Ȃ�
	*/
  //--------------------------------------------------------------------------------------
  public function display()
  {
    global $ERR_STR;
    //PHP�u���b�N�I��
?>
    <!-- �R���e���c -->
    <!doctype html>
    <html>

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>���O�C��</title>

      <!-- �t�H���g -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

      <!-- �X�^�C���V�[�g -->
      <link rel="stylesheet" href="../css/app.css">
      <script src="https://cdn.tailwindcss.com"></script>
      <script src="../common/tailwind.config.js"></script>
    </head>

    <body class="bg-main flex flex-col min-h-screen">

      <div class="flex flex-col items-center justify-center px-6 py-8 md:h-screen lg:py-0">
        <div class="w-full bg-white rounded-lg border border-graycolor md:mt-4 sm:max-w-md xl:p-0">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
            <h1 class="flex justify-center text-xl font-bold leading-tight tracking-tight text-blackcolor md:text-2xl">
              ���O�C��
            </h1>

            <form class="space-y-6" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              <div class="px-6">
                <label class="block mb-2 text-sm font-bold text-blackcolor">���O�C��ID</label>
                <input type="login" name="login" value="" class="bg-lightsub border border-graycolor text-blackcolor sm:text-base rounded hover:border-explain focus:outline-none focus:border-explain block w-full p-2" placeholder="mail@example.com" required>
              </div>
              <div class="px-6">
                <label class="block mb-2 text-sm font-bold text-blackcolor">�p�X���[�h</label>
                <input type="password" name="password" value="" class="bg-lightsub border border-graycolor text-blackcolor sm:text-base rounded hover:border-explain focus:outline-none focus:border-explain block w-full p-2" required>
              </div>
              <div class="px-6">
                <button type="submit" class="w-full text-whitecolor bg-sub hover:bg-subhover rounded-lg py-2.5 text-center">���O�C��</button>
            </form>
          </div>
        </div>
      </div>

    </body>

    </html>
    <!-- /�R���e���c�@-->
<?php
    //PHP�u���b�N�ĊJ
  }
  //--------------------------------------------------------------------------------------
  /*!
	@brief	�f�X�g���N�^
	*/
  //--------------------------------------------------------------------------------------
  public function __destruct()
  {
    //�e�N���X�̃f�X�g���N�^���Ă�
    parent::__destruct();
  }
}

//�y�[�W���쐬
$page_obj = new cnode();
//�w�b�_�ǉ�(���O�C���p)
$page_obj->add_child(cutil::create('cmain_header'));
//�{�̒ǉ�
$page_obj->add_child($main_obj = cutil::create('cmain_node'));
//�t�b�^�ǉ�
$page_obj->add_child(cutil::create('cmain_footer'));
//�\�z������
$page_obj->create();
//�{�̎��s�i�\���O�����j
$main_obj->execute();
//�y�[�W�S�̂�\��
$page_obj->display();

?>