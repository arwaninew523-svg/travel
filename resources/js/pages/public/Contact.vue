<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { reactive } from "vue";

const form = reactive({
  name: '',
  email: '',
  subject: '',
  message: ''
})

function submitForm() {
  alert('Thank you for your message! We will get back to you soon.')
  form.name = ''
  form.email = ''
  form.subject = ''
  form.message = ''
}
</script>

<template>
    <Head title="Contact - Ijen Bromo Travel" />

    <section class="contact-page">
        <div class="contact-bg"></div>
        <div class="contact-overlay"></div>

        <div class="contact-hero">
            <span class="contact-badge">Get In Touch</span>
            <h1 class="contact-title">Contact Us</h1>
            <p class="contact-desc">
                Have a question or ready to plan your trip? Reach out to us and we'll get back to you as soon as possible.
            </p>
        </div>

        <div class="contact-content">
            <div class="contact-info">
                <div class="info-card">
                    <span class="info-icon">📍</span>
                    <div>
                        <h4>Office</h4>
                        <p>Jl. Merdeka No. 123, Jakarta Pusat, Indonesia</p>
                    </div>
                </div>
                <div class="info-card">
                    <span class="info-icon">📞</span>
                    <div>
                        <h4>Phone</h4>
                        <p>+62 812 3456 7890</p>
                    </div>
                </div>
                <div class="info-card">
                    <span class="info-icon">✉️</span>
                    <div>
                        <h4>Email</h4>
                        <p>info@ijenbromotravel.com</p>
                    </div>
                </div>
                <div class="info-card">
                    <span class="info-icon">🕐</span>
                    <div>
                        <h4>Working Hours</h4>
                        <p>Mon - Sat: 08:00 - 18:00</p>
                    </div>
                </div>
            </div>

            <form class="contact-form" @submit.prevent="submitForm">
                <div class="form-row">
                    <input v-model="form.name" type="text" placeholder="Your Name" required />
                    <input v-model="form.email" type="email" placeholder="Your Email" required />
                </div>
                <input v-model="form.subject" type="text" placeholder="Subject" required />
                <textarea v-model="form.message" placeholder="Your Message" rows="6" required></textarea>
                <button type="submit" class="btn-submit">Send Message</button>
            </form>
        </div>
    </section>
</template>

<style scoped>
.contact-page {
  position: relative;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  overflow: hidden;
  padding: 140px 20px 100px;
}

.contact-bg {
  position: absolute;
  inset: -20% 0;
  background:
    linear-gradient(135deg, rgba(10, 10, 20, 0.5) 0%, rgba(20, 15, 40, 0.7) 100%),
    url('https://images.unsplash.com/photo-1518070588484-2b53926cba76?q=80') top / cover no-repeat;
  z-index: 0;
}

.contact-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to bottom, rgba(13, 13, 18, 0.4) 0%, rgba(13, 13, 18, 0.92) 100%);
  z-index: 1;
}

.contact-hero {
  position: relative;
  z-index: 2;
  text-align: center;
  max-width: 600px;
  margin-bottom: 70px;
}

.contact-badge {
  display: inline-block;
  font-size: 0.85em;
  color: #a78bfa;
  text-transform: uppercase;
  letter-spacing: 3px;
  font-weight: 500;
  margin-bottom: 20px;
  background: rgba(167, 139, 250, 0.12);
  padding: 6px 18px;
  border-radius: 20px;
  border: 1px solid rgba(167, 139, 250, 0.2);
}

.contact-title {
  font-size: 3.5em;
  font-weight: 700;
  color: #ffffff;
  line-height: 1.15;
  margin-bottom: 24px;
  letter-spacing: -1.5px;
}

.contact-desc {
  font-size: 1.05em;
  color: #a1a1aa;
  line-height: 1.8;
  max-width: 500px;
  margin: 0 auto 28px;
}

.contact-content {
  position: relative;
  z-index: 2;
  width: 100%;
  max-width: 1100px;
  display: flex;
  gap: 50px;
  align-items: flex-start;
}

.contact-info {
  flex: 0 0 380px;
  display: flex;
  flex-direction: column;
  gap: 18px;
}

.info-card {
  display: flex;
  align-items: center;
  gap: 16px;
  background: rgba(24, 24, 27, 0.7);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border: 1px solid rgba(255, 255, 255, 0.06);
  border-radius: 14px;
  padding: 18px 22px;
  transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.info-card:hover {
  border-color: rgba(167, 139, 250, 0.3);
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
}

.info-icon {
  font-size: 1.6em;
  flex-shrink: 0;
  width: 48px;
  height: 48px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, rgba(167, 139, 250, 0.12), rgba(167, 139, 250, 0.04));
  border: 1px solid rgba(167, 139, 250, 0.1);
  border-radius: 12px;
}

.info-card h4 {
  font-size: 0.9em;
  font-weight: 600;
  color: #ffffff;
  margin-bottom: 4px;
}

.info-card p {
  font-size: 0.82em;
  color: #a1a1aa;
  line-height: 1.5;
}

.contact-form {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 18px;
  background: linear-gradient(145deg, rgba(30, 30, 35, 0.9), rgba(22, 22, 28, 0.95));
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  border: 1px solid rgba(255, 255, 255, 0.06);
  border-radius: 18px;
  padding: 32px;
  box-shadow:
    0 4px 20px rgba(0, 0, 0, 0.3),
    inset 0 1px 0 rgba(255, 255, 255, 0.04);
}

.form-row {
  display: flex;
  gap: 16px;
}

.form-row input {
  flex: 1;
}

.contact-form input,
.contact-form textarea {
  width: 100%;
  padding: 14px 18px;
  background: rgba(13, 13, 18, 0.6);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 12px;
  color: #ffffff;
  font-size: 0.92em;
  font-family: inherit;
  outline: none;
  transition: border-color 0.3s ease;
  box-sizing: border-box;
}

.contact-form input:focus,
.contact-form textarea:focus {
  border-color: rgba(167, 139, 250, 0.5);
}

.contact-form input::placeholder,
.contact-form textarea::placeholder {
  color: #52525b;
}

.btn-submit {
  padding: 16px;
  border: 1px solid rgba(167, 139, 250, 0.4);
  border-radius: 12px;
  background: transparent;
  color: #a78bfa;
  font-size: 0.95em;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.3s ease, color 0.3s ease, border-color 0.3s ease;
  font-family: inherit;
}

.btn-submit:hover {
  background: #a78bfa;
  color: #ffffff;
  border-color: #a78bfa;
}

@media (max-width: 900px) {
  .contact-page {
    padding: 100px 16px 60px;
  }

  .contact-title {
    font-size: 2.4em;
  }

  .contact-hero {
    margin-bottom: 50px;
  }

  .contact-content {
    flex-direction: column;
  }

  .contact-info {
    flex: none;
    width: 100%;
  }

  .form-row {
    flex-direction: column;
  }
}

@media (max-width: 600px) {
  .contact-title {
    font-size: 1.8em;
  }

  .contact-form {
    padding: 24px 20px;
  }
}
</style>
