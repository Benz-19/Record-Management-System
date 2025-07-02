 <main>
     <div class="register-card">
         <h2>Create Your Account</h2>
         <form action="/record_management_system/register" method="POST">
             <div class="message">
                 <?php if (isset($_SESSION['error'])): ?>
                     <p class="error"><?php echo $_SESSION['error']; ?></p>
                     <?php unset($_SESSION['error']); ?>
                 <?php elseif (isset($_SESSION['success'])): ?>
                     <p class="success"><?php echo $_SESSION['success']; ?></p>
                     <?php unset($_SESSION['success']); ?>
                 <?php endif; ?>
             </div>
             <div class="form-group">
                 <label for="username">Username</label>
                 <input type="text" id="username" name="username" placeholder="Choose a username" required>
             </div>
             <div class="form-group">
                 <label for="email">Email Address</label>
                 <input type="email" id="email" name="email" placeholder="your.email@example.com" required>
             </div>
             <div class="form-group">
                 <label for="password">Password</label>
                 <input type="password" id="password" name="password" placeholder="••••••••" required>
             </div>
             <button type="submit" name="registerBtn" class="register-button">Register</button>
         </form>
         <p class="login-link">Already have an account? <a href="/record_management_system/login">Login here</a></p>
     </div>
 </main>
