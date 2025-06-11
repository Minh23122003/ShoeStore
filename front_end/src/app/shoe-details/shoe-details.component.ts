import { Component, OnInit } from '@angular/core';
import { HomeComponent } from '../home/home.component';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { Shoe, ShoesService } from '../services/shoes.service';
import { ActivatedRoute, Router } from '@angular/router';
import { HeaderComponent } from "../header/header.component";

@Component({
  selector: 'app-shoe-details',
  imports: [FormsModule, CommonModule, HeaderComponent],
  templateUrl: './shoe-details.component.html',
  styleUrl: './shoe-details.component.css'
})
export class ShoeDetailsComponent implements OnInit{
  shoe!: Shoe;
  shoeId: number = 0;

  constructor(private shoesService: ShoesService, private route: ActivatedRoute, private router: Router) {};

  ngOnInit(): void {
    this.shoeId = Number(this.route.snapshot.paramMap.get("id"));
    this.shoesService.getShoeById(this.shoeId).subscribe({
      next: (res) => {
        this.shoe = res;
      },
      error: (err) => {
        alert(err);
      }
    });
  }

  goToReserving(): void{
    this.router.navigate(["shoes", this.shoeId, "reserving"]);
  }

}
