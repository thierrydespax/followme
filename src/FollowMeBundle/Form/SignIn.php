<?php
namespace FollowMeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormError;

class SignIn extends AbstractType
{
	
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add("user_mail",
				EmailType::class,
				[
						"label" => "up.mail.addr",
						"constraints" => [
								new Email([
										"message" => "mess.mail"
								]),
								new NotBlank([
										"message" => "mess.mail"
								])
						],
						"attr" => [
								"class" => "form-control",
								"placeholder" => "",
						]
				])
				->add("user_pswd",
						TextType::class,
						[
							"label" => "up.pswd",
							"constraints" => [
									new Regex([
											"pattern" => "/^[\w]{8,32}$/",
											"message" => "mess.pswd"
											
									]),
									new NotBlank([
											"message" => "mess.pswd"
									])
							],
							"attr" => [
									"class" => "form-control",
									"placeholder" => "up.pswd",
							]
						]);			
	}
}