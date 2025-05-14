<?php include "header.php"; ?>

<div class="container py-5">
    <!-- Título principal -->
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-success">Contáctanos</h1>
        <p class="fs-5 text-muted">¿Quieres unirte al club, colaborar o simplemente preguntar algo? ¡Estamos encantados de ayudarte!</p>
    </div>

    <div class="row g-4">
        <!-- Información de contacto y mapa -->
        <div class="col-lg-6">
            <div class="card shadow-lg border-0 h-100">
                <div class="card-body p-4">
                    <h5 class="text-success fw-semibold mb-3"><i class="bi bi-info-circle-fill me-2"></i>Información de Contacto</h5>
                    <p class="mb-2"><i class="bi bi-whatsapp me-2 text-success"></i><strong>+34 612 45 78 90</strong></p>
                    <p class="mb-4"><i class="bi bi-envelope me-2 text-success"></i><strong>contacto@cdmasanz.com</strong></p>

                    <h5 class="text-success fw-semibold mb-3"><i class="bi bi-geo-alt-fill me-2"></i>Ubicación</h5>
                    <iframe class="w-100 rounded shadow-sm mb-3" height="200"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2903.1234567890123!2d-1.6395678!3d42.8123456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd5091234567890%3A0xabcdef1234567890!2sC.%20Milagro%2C%20s%2Fn%2C%2031015%20Pamplona%2C%20Navarra!5e0!3m2!1ses!2ses!4v1610000000000!5m2!1ses!2ses"
                        style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                    <p class="mb-1">Calle Milagro, s/n<br>31015 Pamplona, Navarra</p>
                    <p class="small text-muted">Horario de atención: Lunes a Viernes de 8:00 a 22:00</p>
                </div>
            </div>
        </div>

        <!-- Formulario de contacto -->
        <div class="col-lg-6">
            <div class="card shadow-lg border-0 h-100">
                <div class="card-body p-4">
                    <h5 class="text-success fw-semibold text-center mb-4"><i class="bi bi-chat-dots-fill me-2"></i>Envíanos tu mensaje</h5>
                    <form action="email.php" method="post" novalidate>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Tu nombre completo" required>
                            <label for="name">Nombre completo</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="nombre@correo.com" required>
                            <label for="email">Correo electrónico</label>
                        </div>
                        <div class="form-floating mb-4">
                            <textarea class="form-control" id="message" name="message" placeholder="Escribe tu mensaje..." style="height: 150px;" required></textarea>
                            <label for="message">Mensaje</label>
                        </div>
                        <button type="submit" class="btn btn-success w-100 py-2">
                            <i class="bi bi-send-fill me-2"></i>Enviar Mensaje
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
