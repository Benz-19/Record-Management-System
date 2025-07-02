 <main>
     <div class="login-card">
         <h2>Welcome Back!</h2>
         <form action="/record_management_system/login" method="POST">
             <div class="form-group">
                 <label for="email">Email Address</label>
                 <input type="email" id="email" name="email" placeholder="your.email@example.com" required>
             </div>
             <div class="form-group">
                 <label for="password">Password</label>
                 <input type="password" id="password" name="password" placeholder="••••••••" required>
             </div>
             <button type="submit" name="loginBtn" class="login-button">Login</button>
         </form>
         <p class="register-link">Don't have an account? <a href="/record_management_system/register">Register here</a></p>
     </div>
 </main>
