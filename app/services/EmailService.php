<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

class EmailService
{
    private PHPMailer $mailer;

    public function __construct()
    {
        $this->configureEnvironment();
        $this->mailer = new PHPMailer(true);
        $this->configureMailer();
    }

    private function configureEnvironment(): void
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();
    }

    private function configureMailer(): void
    {
        try {
            $this->mailer->CharSet = 'UTF-8';
            $this->mailer->isSMTP();
            $this->mailer->Host = $_ENV['SMTP_HOST'];
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = $_ENV['SMTP_USER'];
            $this->mailer->Password = $_ENV['SMTP_PASS'];
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mailer->Port = $_ENV['SMTP_PORT'];
        } catch (Exception $e) {
            throw new \RuntimeException("Mailer configuration failed: " . $e->getMessage());
        }
    }

    public function sendAccountApproval(
        string $to,
        string $fullName,
        string $plainPassword,
        string $accountNumber
    ): bool
    {
        $subject = "Votre compte a été approuvé";
        $message = $this->createApprovalMessage($fullName, $to, $plainPassword, $accountNumber);

        return $this->sendEmail(
            $to,
            $subject,
            $message,
            'Confirmation de création de compte'
        );
    }

    public function sendAccountRejection(string $to, string $fullName): bool
    {
        $subject = "Demande de compte refusée";
        $message = $this->createRejectionMessage($fullName);

        return $this->sendEmail(
            $to,
            $subject,
            $message,
            'Notification de refus de compte'
        );
    }

    private function sendEmail(
        string $to,
        string $subject,
        string $message,
        string $altSubject
    ): bool
    {
        try {
            $this->mailer->setFrom($_ENV['EMAIL_FROM'], 'Service Client - Essemlali Bank');
            $this->mailer->addAddress($to);
            $this->mailer->addReplyTo($_ENV['EMAIL_REPLY_TO'], 'Support Technique');

            $this->mailer->isHTML(true);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $this->createEmailTemplate($message, $subject);
            $this->mailer->AltBody = strip_tags($message);

            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            error_log("Email sending error: {$this->mailer->ErrorInfo}");
            return false;
        }
    }

    private function createApprovalMessage(
        string $fullName,
        string $email,
        string $password,
        string $accountNumber
    ): string
    {
        return "
            <p>Bonjour $fullName,</p>
            
            <p>Votre compte a été approuvé avec succès.</p>
            
            <h3>Vos identifiants de connexion :</h3>
            <ul>
                <li><strong>Email :</strong> $email</li>
                <li><strong>Mot de passe temporaire :</strong> $password</li>
                <li><strong>Numéro de compte :</strong> $accountNumber</li>
            </ul>
            
            <p style='color: red; font-weight: bold;'>
                Pour des raisons de sécurité, nous vous recommandons de changer ce mot de passe 
                dès votre première connexion.
            </p>
            
            <p>Cordialement,<br>L'équipe ESSEMLALI-Bank</p>
        ";
    }

    private function createRejectionMessage(string $fullName): string
    {
        return "
            <p>Bonjour $fullName,</p>
            
            <p>Après examen de votre demande, nous sommes au regret de vous informer 
            que votre demande de création de compte a été refusée.</p>
            
            <p>Si vous souhaitez obtenir plus d'informations sur les raisons de ce refus, 
            n'hésitez pas à nous contacter à l'adresse 
            <a href='mailto:support@essemlali-bank.com'>support@essemlali-bank.com</a>.</p>
            
            <p>Cordialement,<br>L'équipe ESSEMLALI-Bank</p>
        ";
    }

    private function createEmailTemplate(string $content, string $title): string
    {
        return "
            <!DOCTYPE html>
            <html lang='fr'>
            <head>
                <meta charset='UTF-8'>
                <style>
                    body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                    .container { max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; }
                    .header { background-color: #f8f9fa; padding: 10px; text-align: center; }
                    .content { padding: 20px; }
                    .footer { margin-top: 20px; padding-top: 10px; border-top: 1px solid #eee; text-align: center; font-size: 0.9em; color: #666; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>
                        <h2>$title</h2>
                    </div>
                    <div class='content'>
                        $content
                    </div>
                    <div class='footer'>
                        ESSEMLALI Bank - Service Client<br>
                        Contact : support@essemlali-bank.com
                    </div>
                </div>
            </body>
            </html>
        ";
    }
}