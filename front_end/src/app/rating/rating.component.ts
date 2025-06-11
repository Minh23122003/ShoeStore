import { Component, OnInit } from '@angular/core';
import { HomeComponent } from '../home/home.component';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { HeaderComponent } from "../header/header.component";
import { Bill, CartService } from '../services/cart.service';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-rating',
  imports: [CommonModule, FormsModule, HeaderComponent],
  templateUrl: './rating.component.html',
  styleUrl: './rating.component.css'
})
export class RatingComponent implements OnInit{
  bill!: Bill;
  billId: number = 0;
  star: number = 1;
  content: string = "";
  error: string = "";

  constructor(private cartService: CartService, private route: ActivatedRoute, private router: Router) {};

  ngOnInit(): void {
    this.billId = Number(this.route.snapshot.paramMap.get("id"));
    this.cartService.getBillById(this.billId).subscribe({
      next: (res) => {
        this.bill = res;
      },
      error: (err) => {
        alert(err);
      }
    });
  }

  rating(): void{
    if(this.content == ""){
      this.error = "Vui lòng nhập nội dung đánh giá!";
    }else{
      let formData = new FormData();
      formData.append("star", String(this.star));
      formData.append("content", this.content);
      formData.append("shoe_id", String(this.bill.shoe.id));

      this.cartService.rating(formData).subscribe({
        next: (res) => {
          alert("Gửi đánh giá thành công!");
          this.router.navigate(["cart"]);
        },
        error: (err) => {
          alert(err);
        }
      })
    }
  }
}
