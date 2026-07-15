<template>
  <footer class="footer">
    <div class="container">
      <div class="grid">
        <div class="col brand-col">
          <h3 class="logo">Ijen <span>Bromo</span> Travel</h3>
          <p class="tagline">Explore the beauty of Indonesia with us. Your adventure begins here.</p>
        </div>

        <div class="col">
          <h4>Contact With Us</h4>
          <ul>
            <li>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              <span>+62 812-1690-4379</span>
            </li>
            <li>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
              <span>info@ijenbromotravel.com</span>
            </li>
          </ul>
        </div>

        <div class="col">
          <h4>Location</h4>
          <ul>
            <li>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              <span>Jl. Raya Bromo No. 123, Malang, Jawa Timur, Indonesia</span>
            </li>
          </ul>
        </div>

        <div class="col">
          <h4>Social Media</h4>
          <div class="social">
            <a href="#" aria-label="Instagram">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
            </a>
            <a href="#" aria-label="Facebook">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
            </a>
            <a href="#" aria-label="Twitter">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg>
            </a>
            <a href="#" aria-label="YouTube">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58 2.78 2.78 0 0 0 1.94 2C5.12 20 12 20 12 20s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02"/></svg>
            </a>
          </div>
        </div>
      </div>

      <div class="bottom">
        <p>&copy; 2026 Asqirizky. All rights reserved.</p>
      </div>
    </div>
  </footer>
</template>

<style scoped>
.footer {
  background: #0d0d12;
  border-top: 1px solid rgba(255, 255, 255, 0.06);
  padding: 80px 20px 0;
}

.container {
  max-width: 1100px;
  margin: 0 auto;
}

.grid {
  display: grid;
  grid-template-columns: 1.5fr 1fr 1fr 1fr;
  gap: 40px;
}

.col h4 {
  color: #ffffff;
  font-size: 1em;
  font-weight: 600;
  margin-bottom: 20px;
  letter-spacing: 0.5px;
}

.logo {
  font-size: 1.4em;
  color: #ffffff;
  font-weight: 600;
  letter-spacing: -0.5px;
  margin-bottom: 12px;
}

.logo span {
  color: #a78bfa;
}

.tagline {
  color: #a1a1aa;
  font-size: 0.9em;
  line-height: 1.7;
  max-width: 280px;
}

.col ul {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 14px;
}

.col ul li {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  color: #a1a1aa;
  font-size: 0.88em;
  line-height: 1.5;
}

.col ul li svg {
  color: #a78bfa;
  flex-shrink: 0;
  margin-top: 2px;
}

.social {
  display: flex;
  gap: 12px;
}

.social a {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 42px;
  height: 42px;
  border-radius: 12px;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.08);
  color: #a1a1aa;
  transition: all 0.3s ease;
}

.social a:hover {
  background: #a78bfa;
  border-color: #a78bfa;
  color: #ffffff;
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(167, 139, 250, 0.3);
}

.bottom {
  margin-top: 60px;
  padding: 24px 0;
  border-top: 1px solid rgba(255, 255, 255, 0.06);
  text-align: center;
}

.bottom p {
  color: #71717a;
  font-size: 0.82em;
}

@media (max-width: 900px) {
  .grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 32px;
  }

  .brand-col {
    grid-column: 1 / -1;
  }
}

@media (max-width: 540px) {
  .footer {
    padding: 50px 16px 0;
  }

  .grid {
    grid-template-columns: 1fr;
    gap: 28px;
  }

  .social a {
    width: 38px;
    height: 38px;
  }
}
</style>
