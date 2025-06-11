import { CommonModule } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { AuthService } from '../services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-register',
  imports: [CommonModule, FormsModule],
  templateUrl: './register.component.html',
  styleUrl: './register.component.css'
})
export class RegisterComponent implements OnInit{
  username: string = "";
  password: string = "";
  passwordConfirm: string = "";
  name: string = "";
  email: string = "";
  address: string = "";
  phone: string = "";
  error: string = "";

  constructor(private authService: AuthService, private router: Router) {};

  ngOnInit(): void {
    
  }

  register(): void{
    if(this.username == "" || this.password == "" || this.passwordConfirm == "" || this.name == "" 
          || this.email == "" || this.address == "" || this.phone == ""){
      this.error = "Vui lòng nhập đầy đủ thông tin!"
    }else if(this.password != this.passwordConfirm){
      this.error = "Mật khẩu và xác nhận mật khẩu không trùng khớp!"
    }else if(this.email.substring(this.email.length - 10) != "@gmail.com"){
      this.error = "Email không hợp lệ!"
    }else{
      let formData = new FormData();
      formData.append("username", this.username);
      formData.append("password", this.password);
      formData.append("name", this.name);
      formData.append("email", this.email);
      formData.append("address", this.address);
      formData.append("phone", this.phone);
      this.authService.register(formData).subscribe({
        next: (res) => {
          alert("Đăng ký thành công!");
          this.router.navigate(["login"]);
        },
        error: (err) => {
          this.error = "Tên đăng nhập đã tồn tại!"
        }
      })
    }
  }

}
