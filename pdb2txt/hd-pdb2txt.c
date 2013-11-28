/*
 Translate Palm Document pdb to text in zh_TW.Big5
 Programmer : Tasuka Hsu
 Date : 2009/Sep/04
*/

#include <stdio.h>
#include <stdlib.h>
#include <string.h>

#define DoubleWord(a) \
	a[0]*256*256*256+ \
        a[1]*256*256+ \
        a[2]*256+ \
        a[3]

#define SingleWord(a) \
	a[0]*256+a[1]

struct pdbHeader {
	unsigned char name[32];
	unsigned char attributes[2];
	unsigned char version[2];
	unsigned char creationDate[4];
	unsigned char modificationDate[4];
	unsigned char lastBackupDate[4];
	unsigned char modificationNumber[4];
	unsigned char appInfoID[4];
	unsigned char sortInfoID[4];
	unsigned char type[4];
	unsigned char creator[4];
	unsigned char uniqueIDseed[4];
	unsigned char nextRecordListID[4];
	unsigned char numberOfRecords[2];
} PDB;
 


int main(int argc, char *argv[])
{
  FILE *fp;
  int i=0,j=0,k=0 ,beg_ch=0,ch_1=0;
  unsigned char c ,c2 ,c3;
  char chk_str[2]; 
  char chk_str2[68]; 
  
  char *filename;
  beg_ch= 0 ;
  c=0 ;
  if(argc>=2){
    filename=(char *)malloc(sizeof(char)*(strlen(argv[1])+1));
    strcpy(filename,argv[1]);
  }else{
    printf("PDB Filename is required.\n");
    return(1);
  }

  if((fp=fopen(filename,"r"))==NULL){
    printf("Can not open %s file\n",argv[1]);
    return(1);
  }
    
  while(!feof(fp)){
    c=fgetc(fp);

    if(i<32)
      PDB.name[i]=c;

    if(i>=32 && i<34)
      PDB.attributes[i-32]=c;

    if(i>=34 && i<36)
      PDB.version[i-34]=c;

    if(i>=36 && i<40)
      PDB.creationDate[i-36]=c;

    if(i>=40 && i<44)
      PDB.modificationDate[i-40]=c;

    if(i>=44 && i<48)
      PDB.lastBackupDate[i-44]=c;

    if(i>=48 && i<52)
      PDB.modificationNumber[i-48]=c;

    if(i>=52 && i<56)
      PDB.appInfoID[i-52]=c;

    if(i>=56 && i<60)
      PDB.sortInfoID[i-56]=c;

    if(i>=60 && i<64)
      PDB.type[i-60]=c;

    if(i>=64 && i<68)
      PDB.creator[i-64]=c;

    if(i>=68 && i<72)
      PDB.uniqueIDseed[i-68]=c;

    if(i>=72 && i<76)
      PDB.nextRecordListID[i-72]=c;

    if(i>=76 && i<78)
      PDB.numberOfRecords[i-76]=c;

    if(i>=78 && i<78+(SingleWord(PDB.numberOfRecords)*8));

    if(i>=79+(SingleWord(PDB.numberOfRecords)*8)){
	if(c!=0x0d){
            if(c==0xff)
		c=0;
	    if(c==0x1b)
		c=0x0a;
	    if(c==0x00){
		c=0x0a;
		printf("\n");
		j--;
	    }
	    if(c==0xa1){
		i++;
		//printf("%c",c);
                
		c=0;
		if(!feof(fp)){
			c=fgetc(fp) ;
			//略去空白全字型
			if  (c==0x40)  
				c=0 ;
			else 	
				printf("%c",0xa1);
 
	 	
				
                        if (beg_ch==1)  
			   c = c-1 ;
		    //標點更改為橫向
		    switch(c){
			case 0x55:c=0x56;break;
			case 0x56:c=0x55;break;
			case 0x57:c=0x58;break;
			case 0x58:c=0x57;break;
			case 0x59:c=0x5a;break;
			case 0x5a:c=0x59;break;
			case 0x5b:c=0x5c;break;
			case 0x5c:c=0x5b;break;
			case 0x5d:c=0x5f;break;
			case 0x5e:c=0x60;break;
			case 0x5f:c=0x5d;break;
			case 0x60:c=0x5e;break;
			case 0x61:c=0x63;break;
			case 0x62:c=0x64;break;
			case 0x63:c=0x61;break;
			case 0x64:c=0x62;break;
			case 0x65:c=0x67;break;
			case 0x66:c=0x68;break;
			case 0x67:c=0x65;break;
			case 0x68:c=0x66;break;
			case 0x69:c=0x6b;break;
			case 0x6a:c=0x6c;break;
			case 0x6b:c=0x69;break;
			case 0x6c:c=0x6a;break;
			case 0x6d:c=0x6f;break;
			case 0x6e:c=0x70;break;
			case 0x6f:c=0x6d;break;
			case 0x70:c=0x6e;break;
			case 0x71:c=0x73;break;
			case 0x72:c=0x74;break;
			case 0x73:c=0x71;break;
			case 0x74:c=0x72;break;
			case 0x75:c=0x77;break;
			case 0x76:c=0x78;break;
			case 0x77:c=0x75;break;
			case 0x78:c=0x76;break;
			case 0x79:c=0x7b;break;
			case 0x7a:c=0x7c;break;
			case 0x7b:c=0x79;break;
			case 0x7c:c=0x7a;break;
			case 0x7d:c=0x5f;break;
			case 0x7e:c=0x60;break;
			case 0x1b:c=0x0a;break;
			case 0xb9:{ 
			   if (	beg_ch ==0 ) {
			   	c2=fgetc( fp) ;
			   	c3=fgetc( fp) ;
			   	if (c2==0xa1 && c3==0xb9)  { 

					beg_ch=1 ;
					//
                                   printf("%c",c);c=0;
                                   for (k=0;k<66;k++)
                                       c3=fgetc( fp) ;  
 
			   	}else{ 
                              		beg_ch=0 ;

			    		ungetc(c3,fp);
			    		ungetc(c2,fp);
 
                          
			    		//c=0;
			   	}  
			  }

			}
			 break;
			case 0xa1:ungetc(c,fp);c=0;i--;break;
			default:break;
		    }
		}
	    }
	    

		
	    if(c!=0)  
	      if (beg_ch) {

                if (c>0xa1) {
 
	           printf("%c",c);
		   c2=fgetc( fp) ;
                   printf("%c",c2-1);
		}else {if(c>=0x81) {  
                     printf("%c",c); 
                     c2=fgetc( fp) ;
                     printf("%c",c2 );  
                   }else    
                    printf("%c",c);  
                }

	      }else {
		  printf("%c",c);
                  ch_1=0 ;
              }
  
	}else {
	    j++;
	}
    }
    i++;
  }
  printf("\n");
  fclose(fp);
/*
  printf("\n\nFilename : %s\n",filename);
  printf("\nPDB Header\n");
  printf("Name : %s\n",PDB.name);
  printf("Attributes : %d\n",SingleWord(PDB.attributes));
  printf("Version : %d\n",SingleWord(PDB.version));
  printf("Creation date : %ds\n",DoubleWord(PDB.creationDate));
  printf("Modification date : %ds\n",DoubleWord(PDB.modificationDate));
  printf("Last backup date : %ds\n",DoubleWord(PDB.lastBackupDate));
  printf("Modification number : %d\n",DoubleWord(PDB.modificationNumber));
  printf("Application Info ID : %d\n",DoubleWord(PDB.appInfoID));
  printf("Sort Info ID : %d\n",DoubleWord(PDB.sortInfoID));
  printf("Type : %d\n",DoubleWord(PDB.type));
  printf("Unique ID Seed : %d\n",DoubleWord(PDB.uniqueIDseed));
  printf("Next Record List ID : %d\n",DoubleWord(PDB.nextRecordListID));
  printf("Number of records : %d\n",SingleWord(PDB.numberOfRecords));
  printf("File Size : %d bytes\n",i-78-(SingleWord(PDB.numberOfRecords)*8)-j);
*/    
  free(filename);
  return(0);
}  
