<?= $this->include('header') ?>

<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        line-height: 1.7;
        color: #333;
    }

    h1 {
        font-weight: 600;
        color: #222;
    }

    p, label, input, textarea {
        font-size: 16px;
    }

    /* Custom button (override Bootstrap) */
    .btn-custom {
        background-color: #000 !important; /* black */
        color: #fff !important; /* white text */
        border: none;
        transition: 0.3s;
    }

    .btn-custom:hover {
        background-color: #333 !important; /* dark gray on hover */
    }
</style>

<div class="container mt-5">
    <h1 class="mb-4">Contact Us</h1>

    <div class="row">
        <!-- Contact Info -->
        <div class="col-md-5 mb-4">
            <p>If you have any questions or inquiries, feel free to contact us.</p>
            <ul class="list-unstyled">
                <li><strong>Email:</strong> airalms@email.com</li>
                <li><strong>Phone:</strong> +63 912 345 6789</li>
                <li><strong>Address:</strong> General Santos City, Philippines</li>
            </ul>
        </div>

        <!-- Contact Form -->
        <div class="col-md-7">
            <form action="<?= base_url('contact/send') ?>" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Your Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                </div>

                <!-- Changed button class -->
                <button type="submit" class="btn btn-custom">Send Message</button>
            </form>
        </div>
    </div>
</div>
