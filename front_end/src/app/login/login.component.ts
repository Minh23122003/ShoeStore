import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { AuthService } from '../services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  imports: [CommonModule, FormsModule],
  templateUrl: './login.component.html',
  styleUrl: './login.component.css'
})
export class LoginComponent implements OnInit{
  username: string = "";
  password: string = "";
  error: string = "";

  constructor(private authService: AuthService, private router: Router) {};

  ngOnInit(): void {
    
  }

  login(): void{
    if(this.username == "" || this.password == ""){
      this.error = "Vui lòng nhập đầy đủ thông tin!"
    }else{
      let formData = new FormData();
      formData.append("username", this.username);
      formData.append("password", this.password);
      this.authService.login(formData).subscribe({
        next: (res) => {
          localStorage.setItem("token", res.token);
          this.router.navigate([""]);
        },
        error: (err) => {
          this.error = "Tên đăng nhập hoặc mật khẩu không chính xác!"
        }
      })
    }
  }

  goToRegister(): void{
    this.router.navigate(["register"]);
  }
}
