//---------------------------------------------------------------------------

#include <vcl.h>
#pragma hdrstop

#include "Unit1.h"
//---------------------------------------------------------------------------
#pragma package(smart_init)
#pragma resource "*.dfm"
TForm1 *Form1;
//---------------------------------------------------------------------------
TColor Couleurs[6] = {clRed, clBlue, clLime, clMaroon, clGreen, clYellow};

__fastcall TForm1::TForm1(TComponent* Owner)
        : TForm(Owner)
{
}

TShape *PCouleur[6];
TShape *PJeu[8][4];
TShape *PRep[8][4];
//---------------------------------------------------------------------------
void PositionnerCarre(TShape *PCarre, int PosX, int PosY, TColor Couleurs)
{
      PCarre->Parent = Form1;
      PCarre->Left = PosX;
      PCarre->Top = PosY;
      PCarre->Height = 20;
      PCarre->Width  = 20;
      PCarre->Brush->Color = Couleurs;
}


void __fastcall TForm1::FormCreate(TObject *Sender)
{
  int
    PosX = 10,
    PosY = 10;
    // Dessine les couleurs à disposition
    for(int i = 0; i < 6; i++) {
      PCouleur[i]= new TShape(Form1);
      PositionnerCarre(PCouleur[i], PosX, PosY, Couleurs[i]);
      PosX += 2*20;
    }

    // Dessine les carrés gris
    PosY += 2 * 20;
    PosX = 10;
    for(int j = 0; j < 8; j++) {
      for(int i = 0; i < 4; i++) {
        PJeu[i][j]= new TShape(Form1);
        PositionnerCarre(PJeu[i][j], PosX, PosY, clGray);
        PosX += 2*20;
      }
      PosY += 2 * 20;
      PosX = 10;
    }
    // Création des reponses
    for(int j = 0; j < 8; j++) {
      for(int i = 0; i < 4; i++) {
        PRep[i][j]= new TShape(Form1);
        PositionnerCarre(PRep[i][j], PosX, PosY, Couleurs[i]);
        PosX += 2*20;
      }
      PosY += 2 * 20;
      PosX = 10;
    }

}
//---------------------------------------------------------------------------
 