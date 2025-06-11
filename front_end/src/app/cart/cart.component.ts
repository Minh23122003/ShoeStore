import { Component, OnInit } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { HeaderComponent } from "../header/header.component";
import { Bill, CartService } from '../services/cart.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-cart',
  imports: [FormsModule, CommonModule, HeaderComponent],
  templateUrl: './cart.component.html',
  styleUrl: './cart.component.css'
})
export class CartComponent implements OnInit{
  bills: Bill[] = [];

  constructor(private cartService: CartService, private router: Router) {};

  ngOnInit(): void {
    this.getBills();
  }

  getBills(): void{
    this.cartService.getBills().subscribe({
      next: (res) => {
        this.bills = res;
      },
      error: (err) => {
        alert(err);
      }
    });
  }

  pay(id: number): void{
    this.cartService.pay(id).subscribe({
      next: (res) => {
        alert("Thanh toán thành công!");
        this.getBills();
      },
      error: (err) => {
        alert(err);
      }
    })
  }

  deleteBill(id:number): void{
    if(confirm("Bạn chắc chắn muốn xóa?")){
      this.cartService.deleteBill(id).subscribe({
        next: (res) => {
          alert("Xóa thành công!");
          this.getBills();
        }
      })
    }
  }

  goToRating(id: number): void{
    this.router.navigate(["cart", "bills", id, "rating"]);
  }
}
