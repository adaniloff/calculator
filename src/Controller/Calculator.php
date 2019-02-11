<?php
/** Namespace */
namespace App\Controller;

/** Usages */
use App\Entity\Operation;
use App\Service\Calculator as ValueCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Regex;

/**
 * Class CalculatorController
 * @package App\Controller
 */
class Calculator extends AbstractController
{
    /**
     * @var ValueCalculator
     */
    private $calculator;

    /**
     * CalculatorController constructor.
     * @param ValueCalculator $calculator
     */
    public function __construct(ValueCalculator $calculator)
    {
        $this->calculator = $calculator;
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function calculate(Request $request)
    {
        $operation = new Operation();

        $form = $this->createFormBuilder($operation)
            ->add('value', TextType::class, [
                'constraints' => [
                    new Regex([
                        'pattern' => Operation::PATTERN,
                        'message' => "The input must be filled with alphanum cars and operators cars only !"
                    ]),
                ]
            ])
            ->add('submit', SubmitType::class, ['label' => 'Calc'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $operation = $form->getData();

            $result = $this->calculator->calculate($operation);
        }

        return $this->render('calculator.html.twig', [
            'result' => $result ?? "",
            'form'   => $form->createView(),
        ]);
    }
}
