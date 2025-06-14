import { Component, OnInit } from '@angular/core';
import { AuthService } from '../services/auth.service';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Router } from '@angular/router';

@Component({
  selector: 'app-header',
  imports: [CommonModule, FormsModule],
  templateUrl: './header.component.html',
  styleUrl: './header.component.css'
})
export class HeaderComponent implements OnInit{
  token: boolean = false;

  constructor(private authService: AuthService, private router:Router) {};

  ngOnInit(): void {
    if(typeof window !== 'undefined'){
      this.token = this.authService.isLogin();
    }
  }

  logout(): void{
    this.authService.logout();
    this.token = false;
  }

  goToCart(): void{
    this.router.navigate(["cart"]);
  }

  goToLogin(): void{
    this.router.navigate(["login"]);
  }
}
